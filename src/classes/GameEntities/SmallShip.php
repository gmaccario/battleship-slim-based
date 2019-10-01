<?php
/**
 * SmallShip
 *
 *
 * @package Battleship
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace GameEntities;

use PropelModels\Ship;

if(!class_exists('SmallShip'))
{
    /**
     * @name AircraftCarrier
     * @description AircraftCarrier
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class SmallShip extends Ship
    {
        /**
         * @name __construct
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __construct(int $startX = 0, int $startY = 0, string $direction = '')
        {
            parent::__construct($startX, $startY, $direction);
            
            $this->length = 1;
            
            $this->type = 'Small Ship';
        }
    }
}