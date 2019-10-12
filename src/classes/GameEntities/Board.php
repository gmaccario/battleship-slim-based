<?php
/**
 * Board
 *
 *
 * @package Battleship
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace GameEntities;

use PropelModels\Fleet;
use PropelModels\Ship;

if(!class_exists('Board'))
{
    /**
     * @name Board
     * @description Board
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class Board
    {
        private $rows = 9;
        private $columns = 9;
        private $board = [];
        
        /**
         * @name __construct
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __construct()
        {
            
        }

        /**
         * @name getBoard
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return array
         */
        public function getBoard() : array
        {
            return $this->board;
        }
        
        /**
         * @name createBoard
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function createBoard()
        {
            for ($row = 0; $row <= $this->rows; $row++) 
            {
                for ($column = 0; $column <= $this->columns; $column++) 
                {
                    $this->board[$row][$column] = -1;
                }
            }
        }
        
        /**
         * @name placeShip
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function placeShip(Ship $ship)
        {
            $this->board[$ship->getStartX()][$ship->getStartY()] = 1;
        }
        
        /**
         * @name prepareBoard
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function prepareBoard(Fleet $fleet = null)
        {
            if($fleet)
            {
                $directions = array('horizontal', 'vertical');
                
                $arrFleet = $fleet->getFleet();
                
                foreach($arrFleet as $ship) 
                {
                    $placingShip = false;
                    
                    while(!$placingShip)
                    {
                        $idRandDirection = array_rand($directions);
                        
                        if($directions[$idRandDirection] == 'horizontal')
                        {
                            $randX = rand(0, $this->rows);
                            $randY = rand(0, $this->columns - $ship->getLength());
                        }
                        else {
                            $randX = rand(0, $this->rows - $ship->getLength());
                            $randY = rand(0, $this->columns);
                        }

                        if($this->board[$randX][$randY] == -1)
                        {
                            $ship->setStartX($randX);
                            $ship->setStartY($randY);
                            
                            $ship->setDirection($directions[$idRandDirection]);
                            
                            $this->placeShip($ship);
                            
                            $ship->setCoordinates($randX, $randY);
                            
                            array_push($this->board, $ship->getCoordinates());
                            
                            $placingShip = true;
                        }
                    }
                }
            }
        }
    }
}