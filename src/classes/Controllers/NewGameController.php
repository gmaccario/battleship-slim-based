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
            
            // New Game
            $game = new Game();
            $game->setToken($token);
            $game->setDifficulty($difficulty);
            $game->save();
            
            // Players
            $players = array('player1', 'player2');
            
            foreach($players as $player)
            {
                // Board
                $board = new Board();
                $board->createBoard();
                
                // Fleet
                $fleet = new Fleet();
                $fleet->setIdGame($game->getId());
                $fleet->setSide($player);
                $fleet->prepareFleet();
                $fleet->save();
                
                // Positioning ships on the board
                $board->prepareBoard($fleet);
                
                // Save ships on db
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
            
            // 200 OK
            return $response->withJson(array('results' => $token), 200);
        }
    }
} 