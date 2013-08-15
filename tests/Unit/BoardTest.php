<?php

class BoardTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Board
     */
    private $board;

    public function setUp()
    {
        $this->board = new Board(5, 5);
    }

    public function testConstructor()
    {
        $this->assertSame(5 ,$this->board->getX());
        $this->assertSame(5 ,$this->board->getY());

    }

    public function testGetHouse()
    {
        $this->assertSame(null, $this->board->getHouse());

        $house = new House();
        $house->setCoord(new Coord(2,1));
        $this->board->plotHouse($house);

        $this->assertSame($house, $this->board->getHouse());
    }

    public function testAddCard()
    {
        $card = new Card();
        $card->setCoord(new Coord(1,2));
        $this->board->addCard($card);

        $map = $this->board->getMap();
        $this->assertSame($card, $map[1][2]);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddCardException()
    {
        $card = new Card();
        $card->setCoord(new Coord(1,2));
        $this->board->addCard($card);

        $card = new Card();
        $card->setCoord(new Coord(1,2));
        $this->board->addCard($card);
    }

    public function testIsValid()
    {
        $this->assertTrue($this->board->isValid(1,1));
        $this->assertFalse($this->board->isValid(0,0));
    }

    public function testGetNeighbours()
    {
        $house = new House();
        $house->setCoord(new Coord(1, 1));
        $this->board->plotHouse($house);

        $neighbours = $this->board->getEmptyNeighbours(new Coord(2, 1));

        // Assert existing spots
        $this->assertContains(array(3, 1), $neighbours, 'Missing right spot');
        $this->assertContains(array(1, 2), $neighbours, 'Missing spot 1,2');
        $this->assertContains(array(2, 2), $neighbours, 'Missing spot 2,2');

        // Assert non-empty spots
        $this->assertNotContains(array(1, 1), $neighbours, 'The house should be on 1,1');
        $this->assertNotContains(array(2, 1), $neighbours, 'The house should be on 2,1');
        $this->assertNotContains(array(1, 0), $neighbours, 'Walked of the board');
    }

    public function testGetNeighbouringCards()
    {
        $house = new House();
        $house->setCoord(new Coord(1, 1));
        $this->board->plotHouse($house);

        $card = new Card();
        $card->setCoord(new Coord(1, 3));
        $this->board->addCard($card);

        $card = new Card();
        $card->setCoord(new Coord(3, 2));
        $this->board->addCard($card);

        $neighbours = $this->board->getNeigbouringCards(new Coord(2, 2));

        // House
        $this->assertContains(array(1, 1), $neighbours, 'Missing house at 1,1');
        $this->assertContains(array(2, 1), $neighbours, 'Missing house at 2,1');

        // Placed cards
        $this->assertContains(array(1, 3), $neighbours, 'Missing Card at 1,3');
        $this->assertContains(array(3, 2), $neighbours, 'Missing Card at 3,2');

        // Empty spots
        $this->assertNotContains(array(1,2), $neighbours, 'Spot 1,2 should be empty');
        $this->assertNotContains(array(2,3), $neighbours, 'Spot 1,2 should be empty');
    }
}
