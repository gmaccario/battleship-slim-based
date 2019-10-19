<?php

namespace PropelModels;

use PropelModels\Base\Ship as BaseShip;

/**
 * Skeleton subclass for representing a row from the 'ship' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Ship extends BaseShip
{
    protected $tmpCoordinates = array(); //[{(x,y),(x,y),(x,y),...]
    
    /**
     * @name getTmpCoordinates
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    public function getTmpCoordinates() : array
    {
        return $this->tmpCoordinates;
    }
    
    /**
     * @name addTmpCoordinates
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    public function addTmpCoordinates(int $startX = 0, int $startY = 0)
    {
        array_push($this->tmpCoordinates, array($startX, $startY));
    }
    
    /**
     * @name resetTmpCoordinates
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    public function resetTmpCoordinates()
    {
        $this->tmpCoordinates = array();
    }
    
    /**
     * @name setCoordinatesOnDirection
     * @description Responsible of the calculation of all ship coordinates stored into DB
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
   public function setCoordinatesOnDirection(int $startX = 0, int $startY = 0)
    {
        $this->startX = $startX;
        $this->startY = $startY;

        if($this->direction == 'horizontal')
        {
            for($i=$this->startY; $i < ($this->startY + $this->length); $i++)
            {
                array_push($this->tmpCoordinates, array($this->startX, $i));
            }
        }
        else {
            for($i=$this->startX; $i < ($this->startX + $this->length); $i++)
            {
                array_push($this->tmpCoordinates, array($i, $this->startY));
            }
        }
    }
}
