<?php
/**
 * HitCoordinatesController
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
use Services\MonologHistoryObserver;

if(!class_exists('HitCoordinatesController'))
{
    /**
     * @name HitCoordinatesController
     * @description 
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class HitCoordinatesController
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
            $x = filter_var($args['x'], FILTER_SANITIZE_NUMBER_INT);
            $y = filter_var($args['y'], FILTER_SANITIZE_NUMBER_INT);
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
                
                // Observer
                //$observer = new MonologHistoryObserver();
                
                // Save on history
                $history = new History();
                $history->setIdGame($gameQuery->getId());
                $history->setPlayer($player);
                $history->setX($x);
                $history->setY($y);
                //$history->attach($observer);
                
                try{
                    $history->save();
                }
                catch(\Exception $ex) {
                    // Save on logs
                    //$history->notify();
                }
                
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
    
                    // Return the hit result
                    return $response->withJson(array('results' => array(
                        'x' => intval($x),
                        'y' => intval($y),
                        'hit' => $hit,
                        'ship' => $affectedShip,
                        'shipId' => $affectedShipId,
                        'hull' => $hullHit,
                        'action' => 'hitCoordinates',
                        
                    )), 200);
                }
            }

            // 200 OK
            return $response->withJson(array('results' => null), 200);
        }
    }
} 