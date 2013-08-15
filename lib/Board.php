<?php
class Board
{
    /**
     * The width of the board, 1 indexed
     * @var int
     */
    private $x;

    /**
     * The height of the board, 1 indexed
     * @var int
     */
    private $y;

    /**
     * @var House
     */
    private $house;

    /** @var  array */
    private $map;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->map = array();
    }

    /**
     * @return House|null
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * @param House $house
     */
    public function plotHouse(House $house)
    {
        $x = $house->getCoord()->getX();
        $y = $house->getCoord()->getY();

        $this->map[$x][$y] = $house;
        $this->map[$x + 1][$y] = $house;

        $this->house = $house;
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @return array
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param $coord Coord
     * @return bool
     */
    public function hasCard(Coord $coord)
    {
        return isset($this->map[$coord->getX()][$coord->getY()]);
    }

    /**
     * @param Card $card
     * @throws InvalidArgumentException
     */
    public function addCard(Card $card)
    {
        if ($this->hasCard($card->getCoord())) {
            throw new \InvalidArgumentException(sprintf('There is already a card on %s,%s', $card->getCoord()->getX(), $card->getCoord()->getY()));
        }

        $this->map[$card->getCoord()->getX()][$card->getCoord()->getY()] = $card;
    }

    /**
     * Determine of a valid exists on the map
     *
     * @param $x
     * @param $y
     * @return bool
     */
    public function isValid($x, $y)
    {
        if ($x < 1 || $x > $this->x) {
            return false;
        }

        if ($y < 1 || $y > $this->y) {
            return false;
        }

        return true;
    }

    /**
     * @param $x
     * @param $y
     * @return bool
     */
    public function isEmpty($x, $y)
    {

        return $this->isValid($x, $y) && !isset($this->map[$x][$y]);
    }

    /**
     * Returns an array with neighbour fields that actually exist and don't
     * have a card on it yet
     *
     * @param $coord Coord
     * @return array
     */
    public function getEmptyNeighbours(Coord $coord)
    {
        $neighbours = array();

        $map = $coord->getSurroundingMap();
        foreach ($map as $coord) {

            if ($this->isEmpty($coord[0], $coord[1])) {
                $neighbours[] = $coord;
            }
        }

        return $neighbours;
    }

    /**
     * @param Coord $coord
     * @return array
     */
    public function getNeigbouringCards(Coord $coord)
    {
        $neighbours = array();

        $map = $coord->getSurroundingMap();
        foreach ($map as $coord) {
            if (!$this->isEmpty($coord[0], $coord[1])) {
                $neighbours[] = $coord;
            }
        }

        return $neighbours;
    }

}