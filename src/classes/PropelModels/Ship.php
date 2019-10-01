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
    /**
     * Protected because Ship extensions
     */
    protected $type = '';
    protected $length = 0;
    protected $startX = 0; // start point on rows
    protected $startY = 0; // start point on cols
    protected $direction = 'horizontal';
    protected $coordinates = array();
    
    /**
     * @name __construct
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    public function __construct(int $startX = 0, int $startY = 0, string $direction = '')
    {
        $this->startX = $startX;
        $this->startY = $startY;
        $this->direction = $direction;
        $this->setCoordinates($startX, $startY);
        
        $this->length = 0;
        $this->type = 'Unknown';
    }
    
    /**
     * @name getCoordinates
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    public function getCoordinates()
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
        
        $this->coordinates = array();
        
        if($this->direction == 'horizontal')
        {
            for($i=$this->startY; $i < ($this->startY + $this->length); $i++)
            {
                array_push($this->coordinates, array($this->startX, $i));
            }
        }
        else {
            for($i=$this->startX; $i < ($this->startX + $this->length); $i++)
            {
                array_push($this->coordinates, array($i, $this->startY));
            }
        }
    }
}
