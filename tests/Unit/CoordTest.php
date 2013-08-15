<?php
/**
 * This file and its content is copyright of Beeldspraak Website Creators BV - (c) Beeldspraak 2012. All rights reserved.
 * Any redistribution or reproduction of part or all of the contents in any form is prohibited.
 * You may not, except with our express written permission, distribute or commercially exploit the content.
 *
 * @author      Beeldspraak <info@beeldspraak.com>
 * @copyright   Copyright 2012, Beeldspraak Website Creators BV
 * @link        http://beeldspraak.com
 *
 */

class CoordTest extends PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $coord = new Coord(3,4);
        $this->assertSame(3, $coord->getX());
        $this->assertSame(4, $coord->getY());
    }

    public function testSurroundingMap()
    {
        $coord = new Coord(3,3);

        $this->assertSame(
            array(
                array(2,2),
                array(2,3),
                array(2,4),
                array(3,2),
                array(3,4),
                array(4,2),
                array(4,3),
                array(4,4),
            ),
            $coord->getSurroundingMap()
        );
    }

    public function testToArray()
    {
        $coord = new Coord(2,2);

        $this->assertSame(array(2,2), $coord->toArray());
    }
}