<?php
/**
 * GetFleetController
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

if(!class_exists('GetFleetController'))
{
    /**
     * @name HitCoordinatesController
     * @description 
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class GetFleetController
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
                
                $results = array();
                
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
                        array_push($results, array(
                            'id' => $ship->getId(),
                            'type' => $ship->getType(),
                            'len' => $ship->getLength(),
                        ));
                    }
                }
                
                // 200 OK
                return $response->withJson(array('results' => $results), 200);
            }
        }
    }
} 