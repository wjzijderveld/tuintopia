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

class CardManager 
{

    /**
     * @param Card $card
     * @param Card $neighbour
     * @return int
     */
    public function calculatePoints(Card $card, Card $neighbour)
    {
        $result = 0;

        $result += count(array_intersect($card->getInputs(), $neighbour->getOutputs()));
        $result += count(array_intersect($neighbour->getInputs(), $card->getOutputs()));

        return $result;
    }
}