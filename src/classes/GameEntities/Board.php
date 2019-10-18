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

use PropelModels\Ship;
use Services\AbstractSubject;
use Services\AbstractObserver;

if(!class_exists('Board'))
{
    /**
     * @name Board
     * @description Board
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class Board extends AbstractSubject
    {
        private $rows = 9;
        private $columns = 9;
        private $board = [];
        private $recursions = 0;
        private $observers = array();
        
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
         * @name attach - Observer Pattern
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return array
         */
        function attach(AbstractObserver $observer_in) 
        {
            //could also use array_push($this->observers, $observer_in);
            $this->observers[] = $observer_in;
        }
        
        /**
         * @name detach - Observer Pattern
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return array
         */
        function detach(AbstractObserver $observer_in) 
        {
            //$key = array_search($observer_in, $this->observers);
            foreach($this->observers as $okey => $oval) 
            {
                if ($oval == $observer_in) 
                {
                    unset($this->observers[$okey]);
                }
            }
        }
        
        /**
         * @name notify - Observer Pattern
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return array
         */
        function notify() 
        {
            foreach($this->observers as $obs) 
            {
                $obs->update($this);
            }
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
         * @name getRecursions
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return int
         */
        public function getRecursions() : int
        {
            return $this->recursions;
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
         * @name placeShipOnBoard
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function placeShipOnBoard(Ship &$ship)
        {
            // Random direction
            $directions = array('horizontal', 'vertical');
            $idRandDirection = array_rand($directions);
            $randDirection = $directions[$idRandDirection];
            
            // Get Boundaries
            $rws = $this->rows - $ship->getLength();
            $cls = $this->columns + 1;
            
            if($randDirection == 'horizontal')
            {
                $rws = $this->rows + 1;
                $cls = $this->columns - $ship->getLength();
            }
            
            // Get All available cells
            $availableCells = array();
            for ($row = 0; $row <= $rws; $row++)
            {
                for ($column = 0; $column <= $cls; $column++)
                {
                    if(isset($this->board[$row][$column]))
                    {
                        if($this->board[$row][$column] == -1)
                        {
                            array_push($availableCells, array($row, $column));
                        }
                    }
                }
            }
            
            // Get random X/Y from available cells
            $randomIndex = array_rand($availableCells);
            $randomCoordinates = $availableCells[$randomIndex];
            list($randX, $randY) = $randomCoordinates;
            
            // Set new Ship attributes
            $ship->setStartX($randX);
            $ship->setStartY($randY);
            $ship->setDirection($randDirection);
            $ship->setCoordinatesOnDirection($randX, $randY);

            // Check coordinates: If they are already taken, recursion
            $allShipCoordinates = $ship->getTmpCoordinates();
            foreach($allShipCoordinates as $coordinates)
            {
                list($x, $y) = $coordinates;

                // Already taken? Recursion
                if($this->board[$x][$y] != -1)
                {
                    // Reset ship coordinates
                    $ship->resetTmpCoordinates();
                    
                    // Increase recursions
                    $this->recursions += 1;
                    
                    // Recursion!
                    $this->placeShipOnBoard($ship);
                    
                    return;
                }
            }
            
            // Write on log
            $this->notify(); 
            
            // Reset recursions
            $this->recursions = 0;
            
            // Set all the coordinate as taken
            foreach($allShipCoordinates as $coordinates)
            {
                list($x, $y) = $coordinates;
                
                $this->board[$x][$y] = 1;
            }
        }
    }
}