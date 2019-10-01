<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Entities\Board;
use \Entities\Fleet;
use \Entities\Ship;

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
        
        $ship = new Ship('battleship', 1, 0);
        
        $board->placeShip($ship);
        
        $actual = $board->getBoard()[1][0];
        
        $this->assertEquals(1, $actual);
    }
    
    public function testPrepareBoard(): void
    {
        $board = new Board();
        $board->createBoard();
        
        $ship = new Ship('battleship', 0, 0);

        $board->placeShip($ship);
        
        $actual = $board->getBoard()[0][0];
        
        $this->assertEquals(1, $actual);
    }
}