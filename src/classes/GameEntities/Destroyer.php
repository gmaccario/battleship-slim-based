<?php
/**
 * Destroyer
 *
 *
 * @package Battleship
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace GameEntities;

use PropelModels\Ship;

if(!class_exists('Destroyer'))
{
    /**
     * @name AircraftCarrier
     * @description AircraftCarrier
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class Destroyer extends Ship
    {
        /**
         * @name __construct
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __construct()
        {
            parent::__construct();
            
            $this->length = 2;
            
            $this->type = 'Destroyer';
        }
    }
}