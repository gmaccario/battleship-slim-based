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
                return $response->withJson(array('error' => 'Invalid token'), 200);
            }
            else {
                
                // @todo save on history
                
                // Check if there is a ship at those coordinates, in the player board
                $hit = false;
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
                        
                        // Set all coordinates based on x, y, len and direction
                        $ship->setCoordinates($ship->getStartx(), $ship->getStarty());
                        
                        // Otherwise check over all coordinates
                        $allShipCoordinates = $ship->getCoordinates();
                        
                        $i = 0;
                        while ($i < count($allShipCoordinates) - 1)
                        {
                            if($x == $allShipCoordinates[$i][0] && $y == $allShipCoordinates[$i][1])
                            {
                                $hit = true;
                                
                                $affectedShip = $ship->getType();
                                $affectedShipId = $ship->getId();
                                
                                break 2; // break both loops
                            }
                            
                            $i++;
                        }
                        
                        $ship->resetCoordinates();
                    }
    
                    // Return the hit result
                    return $response->withJson(array('results' => array(
                        'x' => $x,
                        'y' => $y,
                        'hit' => $hit,
                        'ship' => $affectedShip,
                        'shipId' => $affectedShipId,
                        
                    )), 200);
                }
            }

            // 200 OK
            return $response->withJson(array('results' => null), 200);
        }
    }
} 