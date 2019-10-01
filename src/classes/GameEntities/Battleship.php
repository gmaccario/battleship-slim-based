<?php
/**
 * Ship
 *
 *
 * @package Battleship
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace GameEntities;

use PropelModels\Ship;

if(!class_exists('Battleship'))
{
    /**
     * @name Battleship
     * @description Battleship
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class Battleship extends Ship
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
            
            $this->length = 4;
            
            $this->type = 'Battleship';
        }
    }
}