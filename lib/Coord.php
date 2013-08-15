<?php

class Coord 
{
    /** @var  int */
    private $x;

    /** @var  int */
    private $y;

    /**
     * @param $x int
     * @param $y int
     */
    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
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
    public function toArray()
    {
        return array($this->x, $this->y);
    }

    /**
     * @return array
     */
    public function getSurroundingMap()
    {
        $map = array();
        for ($x = $this->x - 1; $x <= $this->x + 1; $x++) {

            for ($y = $this->y - 1; $y <= $this->y + 1; $y++) {
                if (!($x === $this->x && $y === $this->y)) {
                    $map[] = array($x, $y);
                }
            }
        }

        return $map;
    }
}