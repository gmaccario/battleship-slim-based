<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \GameEntities\Board;
use PropelModels\Ship;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

final class BoardTest extends TestCase
{
    public function testEmptyBoard(): void
    {
        $board = new Board();
        
        $this->assertCount(0, $board->getBoard());
    }
    
    public function testFullBoard(): void
    {
        $board = new Board();
        $board->createBoard();
        
        $this->assertCount(10, $board->getBoard());
    }
    
    public function testPlaceShip(): void
    {
        $board = new Board();
        $board->createBoard();
        
        $ship = new Ship();
        $ship->setType('battleship');
        $ship->setStartx(1);
        $ship->setStarty(5);
        
        $board->placeShip($ship);
        
        $actual = $board->getBoard()[1][5];
        
        $this->assertEquals(1, $actual);
    }
    
    public function testPrepareBoard(): void
    {
        $board = new Board();
        $board->createBoard();
        
        $ship = new Ship();
        $ship->setType('battleship');
        $ship->setStartx(0);
        $ship->setStarty(0);

        $board->placeShip($ship);
        
        $actual = $board->getBoard()[0][0];
        
        $this->assertEquals(1, $actual);
    }
}