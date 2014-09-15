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

require __DIR__ . '/init.php';

$dataDir = './';

$options = getopt('d:');

if (isset($options['d']) && false !== $options['d']) {
    $dataDir = $options['d'];
}

$cardsFile = $dataDir . DIRECTORY_SEPARATOR . 'kaarten.ini';
$boardFile = $dataDir . DIRECTORY_SEPARATOR . 'speelveld.ini';

if (!file_exists($cardsFile) || !file_exists($boardFile)) {
    echo 'Could not find the required files kaarten.ini and/or speelveld.ini' . PHP_EOL;
    echo 'Look in: ' . $dataDir . PHP_EOL;
    exit(1);
}

$cards = parse_ini_file($cardsFile, true);
$board = parse_ini_file($boardFile, true);

list ($houseX, $houseY) = explode(',', $board['speelveld']['eerstehuisdeel']);
$boardX = (int)$board['speelveld']['aantalveldenxas'];
$boardY = (int)$board['speelveld']['aantalveldenyas'];
$board = new Board($boardX, $boardY);

$availableCards = array();
foreach ($cards as $type => $cardData) {
    switch ($type) {
        case 'huis':
            $card = new House();
            break;
        default:
            $card = new Card();
    }

    $card->setType($type);
    $card->setInputs(explode(',', $cardData['input']));
    $card->setOutputs(explode(',', $cardData['output']));

    // A house gets a special treatment
    // Set the known coordinates and plot it on the map
    if ($card instanceOf House) {
        $card->setCoord(new Coord((int)$houseX, (int)$houseY));
        $board->plotHouse($card);
    } else {
        $availableCards[] = $card;

        for ($i = 1; $i <= (int)$cardData['aantal'] - 1; $i++) {
            $availableCards[] = clone $card;
        }
    }
}

// Create a map with all inputs => outputs
// and a map with all outputs => inputs

$cardManager = new CardManager();
$emptyNeighbours = $board->getEmptyNeighbours($board->getHouse()->getCoord());

$pointMap = array();
foreach ($availableCards as $card) {
    $points = $cardManager->calculatePoints($card, $board->getHouse());

    if (!isset($pointMap[$points])) {
        $pointMap[$points] = array();
    }

    $pointMap[$points][] = $card;
}

// Sort on highest points
krsort($pointMap);

// Shift cards of until we have enough
$maxPoints = key($pointMap);
$cardStack = array();
$cardStack[$maxPoints] = $pointMap[$maxPoints];
unset($pointMap[$maxPoints]);

$cardCount = count($cardStack[$maxPoints]);

while ($cardCount < count($emptyNeighbours)) {

    $maxPoints = key($pointMap);
    $cardStack[$maxPoints] = $pointMap[$maxPoints];

    unset($pointMap[$maxPoints]);

    $cardCount += count($cardStack[$maxPoints]);

    if (!count($pointMap)) {
        break;
    }
}

$points = 0;
$totalPoints = 0;

$cards = array();
foreach ($emptyNeighbours as $neighbour) {

    if (!count($cards)) {
        $points = key($cardStack);
        $cards = $cardStack[$points];
        unset($cardStack[$points]);
    }

    /** @var Card $card */
    $card = array_shift($cards);
    $coord = new Coord($neighbour[0], $neighbour[1]);

    // Retrieve index before setting the coord
    $index = array_search($card, $availableCards);

    $card->setCoord($coord);
    $board->addCard($card);
    unset($availableCards[$index]);

    $totalPoints += $points;
}

echo 'Total points (non-finished game): ' . $totalPoints . PHP_EOL;

// TODO: Calculate (in a recursive funciton) next card to get empty neighbours from
