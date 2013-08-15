<?php

class CardManagerTest extends PHPUnit_Framework_TestCase
{
    private $cardManager;

    public function setUp()
    {
        $this->cardManager = new CardManager();
    }

    public function testCalculatePoints()
    {
        $card = new Card();
        $neighbour = new Card();

        $cardInputs = array(
            'voedsel',
            'water',
            'stroom',
        );
        $cardOutputs = array(
            'plantenresten',
            'afvalwater',
            'afdak',
        );

        $neighbourInputs = array(
            'mest',
            'bevruchting',
            'plaagbestrijders',
        );
        $neighbourOutputs = array(
            'voedsel',
            'plantenresten',
            'nectar',
        );

        $card->setType('boomgaard');
        $card->setInputs($cardInputs);
        $card->setOutputs($cardOutputs);

        $neighbour->setType('groentetuin');
        $neighbour->setInputs($neighbourInputs);
        $neighbour->setOutputs($neighbourOutputs);

        $this->assertSame(1, $this->cardManager->calculatePoints($card, $neighbour), 'The cards have 1 item in common');
    }
}