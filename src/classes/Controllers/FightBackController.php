<?php
/**
 * FightBackController
 *
 *
 * @package Battleship
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use PropelModels\GameQuery;
use PropelModels\FleetQuery;
use PropelModels\History;
use PropelModels\HistoryQuery;
use Services\MonologHistoryObserver;

if(!class_exists('FightBackController'))
{
    /**
     * @name FightBackController
     * @description 
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class FightBackController
    {        
        /**
         * @name __invoke
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __invoke(Request $request, Response $response, array $args)
        {
            // Get GET parameters
            $player = filter_var($args['player'], FILTER_SANITIZE_STRING);
            
            // Get token from header
            $token = $request->getHeaderLine('Authorization');

            $gameQuery = GameQuery::create()
            ->filterByToken($token)
            ->findOne();
            
            if(!$gameQuery)
            {
                return $response->withJson(array('error' => 'Invalid token'), 401);
            }
            else {

                // Get history per player
                $historyQuery = HistoryQuery::create()
                ->filterByIdGame($gameQuery->getId())
                ->filterByPlayer($player)
                ->find();

                // History moves
                $moves = array();
                $historyMovement = $historyQuery->getData();
                foreach($historyMovement as $move)
                {
                    array_push($moves, array($move->getX(), $move->getY()));
                }
                
                // Board
                // @todo Refactoring using DB
                $board = array();
                for ($row = 0; $row <= 9; $row++)
                {
                    for ($column = 0; $column <= 9; $column++)
                    {
                        array_push($board, array($row, $column));
                    }
                }
                
                // Get random coordinates
                $diff = array_diff_assoc($board, $moves);
                $idRandomCoordinates = array_rand($diff);
                $randomCoordinates = $diff[$idRandomCoordinates];
                
                list($x, $y) = $randomCoordinates;
                
                // Check if there is a ship at those coordinates, in the player board
                $hit = false;
                $hullHit = 0;
                $affectedShip = '';
                $affectedShipId = 0;
                
                // Get the fleet of the player
                $fleetQuery = FleetQuery::create()
                ->filterByIdGame($gameQuery->getId())
                ->filterBySide($player)
                ->findOne();
                
                // @todo Same code in HitCoordinates, create something general
                if($fleetQuery)
                {
                    $ships = $fleetQuery->getShips();
                    
                    // Check inside the fleet if there is a ship on these coordinates
                    foreach($ships as $ship)
                    {
                        // Edge case: hit at first attempt
                        if($x == $ship->getStartx() && $y == $ship->getStarty())
                        {
                            $hit = true;
                            
                            $affectedShip = $ship->getType();
                            $affectedShipId = $ship->getId();
                            
                            break;
                        }
                        
                        // Otherwise check over all coordinates
                        $allShipCoordinates = json_decode($ship->getCoordinates(), true);
                        
                        $hullHit = 0;
                        foreach($allShipCoordinates as $index => $coordinates)
                        {
                            if($x == $coordinates[0] && $y == $coordinates[1])
                            {
                                $hit = true;
                                
                                $hullHit = $index;
                                
                                $affectedShip = $ship->getType();
                                $affectedShipId = $ship->getId();
                                
                                break 2; // break both loops
                            }
                        }
                        
                        $ship->resetTmpCoordinates();
                    }
                    
                    // Observer
                    //$observer = new MonologHistoryObserver();
                    
                    // Save on history
                    $history = new History();
                    $history->setIdGame($gameQuery->getId());
                    $history->setPlayer($player);
                    $history->setX($x);
                    $history->setY($y);
                    $history->setHit($hit);
                    //$history->attach($observer);
                    
                    try{
                        $history->save();
                    }
                    catch(\Exception $ex) {
                        // Save on logs
                        //$history->notify();
                    }
                    
                    
                    // Return the hit result
                    return $response->withJson(array('results' => array(
                        'x' => intval($x),
                        'y' => intval($y),
                        'hit' => $hit,
                        'ship' => $affectedShip,
                        'shipId' => $affectedShipId,
                        'hull' => $hullHit,
                        'action' => 'fightBack',
                        'player' => $player
                        
                    )), 200);
                }
            }

            // 200 OK
            return $response->withJson(array('results' => null), 200);
        }
    }
} 