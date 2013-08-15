<?php

class CardTest extends PHPUnit_Framework_TestCase
{
    public function testSetInputsAndOutputs()
    {
        $card = new Card();
        $card->setInputs(array('foo','bar'));
        $card->setOutputs(array('zeta','alpha','beta'));

        $this->assertSame(array('bar', 'foo'), $card->getInputs());
        $this->assertSame(array('alpha', 'beta', 'zeta'), $card->getOutputs());
    }
}
