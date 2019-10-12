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
    protected $coordinates = array(); //[{(x,y),(x,y),(x,y),...]
    
    /**
     * @name getCoordinates
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    public function getCoordinates() : array
    {
        return $this->coordinates;
    }
    
    /**
     * @name addCoordinates
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    public function addCoordinates(int $startX = 0, int $startY = 0)
    {
        array_push($this->coordinates, array($startX, $startY));
    }
    
    /**
     * @name resetCoordinates
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    public function resetCoordinates()
    {
        $this->coordinates = array();
    }
    
    /**
     * @name setCoordinates
     *
     * @note Double check on these paramters
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    public function setCoordinates(int $startX = 0, int $startY = 0)
    {
        $this->startX = $startX;
        $this->startY = $startY;

        if($this->direction == 'horizontal')
        {
            for($i=$this->startX; $i < ($this->startX + $this->length); $i++)
            {
                array_push($this->coordinates, array($i, $this->startY));
            }
        }
        else {
            for($i=$this->startY; $i < ($this->startY + $this->length); $i++)
            {
                array_push($this->coordinates, array($this->startX, $i));
            }
        }
    }
}
