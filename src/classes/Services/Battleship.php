<?php
/**
 * Battleship
 *
 * @description
 * @package Battleship
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Services;

use PropelModels\GameQuery;
use PropelModels\FleetQuery;
use PropelModels\Game;
use PropelModels\Fleet;
use PropelModels\Ship;

use GameEntities\Board;

if(!class_exists('Battleship'))
{
    /**
     * Battleship
     *
     * @description
     * @package Battleship
     * @author Giuseppe Maccario <g_maccario@hotmail.com>
     * @version 1.0
     * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
     */
    class Battleship
    {
        /**
         * @property Auth $auth
         *
         */
        protected $auth = null;
        
        /**
         * @name __construct
         *
         * @partam Auth $auth
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __construct(Auth $auth)
        {
            $this->auth = $auth;
        }
        
        /**
         * @name setup
         *
         * Create a token related to the new game
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return bool
         */
        public function setup() : bool
        {
            /*
             * New Game
             */
            $game = new Game();
            $game->setToken($this->auth->getToken());
            $game->save();
            
            /**
             * Players
             */
            $players = array('player1', 'player2');
            
            foreach($players as $player)
            {
                /**
                 * Board
                 */
                $board = new Board();
                $board->createBoard();
                
                /*
                 * Fleet
                 */
                $fleet = new Fleet();
                $fleet->setIdGame($game->getId());
                $fleet->setSide($player);
                $fleet->prepareFleet();
                $fleet->save();
                
                /*
                 * Positioning ships on the board
                 */
                $board->prepareBoard($fleet);
                
                /*
                 * Save ships on db
                 */
                foreach($fleet->getFleet() as $FleetShip)
                {
                    $ship = new Ship();
                    $ship->setIdFleet($fleet->getId());
                    $ship->setType($FleetShip->getType());
                    $ship->setLength($FleetShip->getLength());
                    $ship->setStartx($FleetShip->getStartx());
                    $ship->setStarty($FleetShip->getStarty());
                    $ship->setDirection($FleetShip->getDirection());
                    $ship->save();
                }
            }
            
            return true;
        }
        
        /**
         * @name hitCoordinates
         *
         * @param int $x
         * @param int $y
         * @param string $player
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return array
         */
        public function hitCoordinates(int $x, int $y, string $player) : array
        {
            /*
             * Get Game from db, filter by token
             */
            $gameQuery = GameQuery::create()
                ->filterByToken($this->auth->getToken())
                ->findOne();
            
            /*
             * Game (token) exists?
             */
            if(!$gameQuery)
            {
                return array(
                    'message-error' => 'Invalid token.',
                    
                );
            }
            else {
                
                /*
                 * Check if there is a ship at those coordinates, in the player board
                 */
                $hit = false;
                $affectedShip = '';
                
                /*
                 * Get the fleet of the player
                 */
                $fleetQuery = FleetQuery::create()
                ->filterByIdGame($gameQuery->getId())
                ->filterBySide($player)
                ->findOne();
                
                /*
                 * Check inside the fleet if there is a ship on these coordinates
                 */
                foreach($fleetQuery->getShips() as $ship)
                {
                    /*
                     * @todo Double check on this method
                     * */
                    $ship->setCoordinates($ship->getStartx(), $ship->getStarty());
                    
                    /*
                     * Edge case: hit at first attempt
                     */
                    if($x == $ship->getStartx() && $y == $ship->getStarty())
                    {
                        $hit = true;
                        
                        $affectedShip = $ship->getType();
                        
                        break;
                    }
                    
                    /*
                     * Otherwise check over all coordinates
                     */
                    $allShipCoordinates = $ship->getCoordinates();
                    
                    foreach($allShipCoordinates as $shipCoordinates)
                    {
                        if($x == $shipCoordinates[0] && $y == $shipCoordinates[1])
                        {
                            $hit = true;
                            
                            $affectedShip = $ship->getType();
                            
                            break 2; // break both loops
                        }
                    }
                }
                
                /**
                 * @todo save on history
                 */
                
                /*
                 * Return the hit result
                 */
                return array(
                    'x' => $x,
                    'y' => $y,
                    'hit' => $hit,
                    'ship' => $affectedShip,
                    
                );
            }
            
            return array();
        }
    }
}