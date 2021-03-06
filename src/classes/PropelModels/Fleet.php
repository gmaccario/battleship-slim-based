<?php

namespace PropelModels;

use PropelModels\Base\Fleet as BaseFleet;
use GameEntities\Battleship;
use GameEntities\AircraftCarrier;
use GameEntities\Destroyer;
use GameEntities\SmallShip;

/**
 * Skeleton subclass for representing a row from the 'fleet' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Fleet extends BaseFleet
{
    private $ships = array();
    
    /**
     * @name __construct
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    public function __construct(Ship $ship = null)
    {
        if($ship)
        {
            array_push($this->ships, $ship);
        }
    }
    
    /**
     * @name getFleet
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return array
     */
    public function getFleet() : array
    {
        return $this->ships;
    }
    
    /**
     * @name addShip
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    public function addShip(Ship $ship)
    {
        array_push($this->ships, $ship);
    }
    
    /**
     * @name prepareFleet
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    public function prepareFleet()
    {
        array_push($this->ships, new Battleship());
        
        array_push($this->ships, new AircraftCarrier());
        array_push($this->ships, new AircraftCarrier());
        
        array_push($this->ships, new Destroyer());
        array_push($this->ships, new Destroyer());
        array_push($this->ships, new Destroyer());
        
        array_push($this->ships, new SmallShip());
        array_push($this->ships, new SmallShip());
        array_push($this->ships, new SmallShip());
        array_push($this->ships, new SmallShip());
    }
}
