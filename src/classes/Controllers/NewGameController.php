<?php
/**
// NewGameController

// @package Battleship
// @author Giuseppe Maccario <g_maccario@hotmail.com>
// @version 1.0
// @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use PropelModels\Game;
use GameEntities\Board;
use PropelModels\Fleet;
use PropelModels\Ship;
use Services\MonologObserver;

if(!class_exists('NewGameController'))
{
    /**
     // @name NewGameController
     // @description
     *
     // @author G.Maccario <g_maccario@hotmail.com>
     // @return
     */
    class NewGameController
    {
        // Players
        private $players = array('player1', 'player2');
        
        /**
         // @name __invoke
         *
         // @author G.Maccario <g_maccario@hotmail.com>
         // @return
         */
        public function __invoke(Request $request, Response $response, array $args)
        {
            // Get GET parameters
            $difficulty = filter_var($args['difficulty'], FILTER_SANITIZE_STRING);
            
            // Get token from header
            $token = $request->getHeaderLine('Authorization');
            
            if(!$token)
            {
                // 200 OK
                return $response->withJson(array('error' => 'Invalid token'), 401);
            }
            else {
                // New Game
                $game = new Game();
                $game->setToken($token);
                $game->setDifficulty($difficulty);
                $game->save();
                
                // Prepare board for each players
                foreach($this->players as $player)
                {
                    // Observer
                    $observer = new MonologObserver();
                    
                    // Board
                    $board = new Board();
                    $board->createBoard();
                    $board->attach($observer);
                    
                    // Fleet
                    $fleet = new Fleet();
                    $fleet->setIdGame($game->getId());
                    $fleet->setSide($player);
                    $fleet->prepareFleet();
                    $fleet->save();
                    
                    // Ships
                    $ships = $fleet->getFleet();

                    // Save ships on db
                    foreach($ships as $shipInFleet)
                    {
                        // Positioning ships on the board
                        $board->placeShipOnBoard($shipInFleet);

                        // Create new ship and save
                        $ship = new Ship();
                        $ship->setIdFleet($fleet->getId());
                        $ship->setType($shipInFleet->getType());
                        $ship->setLength($shipInFleet->getLength());
                        $ship->setStartx($shipInFleet->getStartx());
                        $ship->setStarty($shipInFleet->getStarty());
                        $ship->setDirection($shipInFleet->getDirection());
                        $ship->setCoordinates(json_encode($shipInFleet->getTmpCoordinates()));

                        // Save new ship
                        try{
                            $ship->save();
                        }
                        catch(\Exception $ex) {
                            throw new \Exception($ex->getCode() . ' ' . $ex->getMessage());
                        }
                    }
                }
                
                // 201 Created
                return $response->withJson(array('results' => $token), 201);
            }
        }
    }
} 