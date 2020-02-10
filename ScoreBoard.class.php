<?php

include 'Player.class.php';

class ScoreBoard {

    private array $players;

    public function addPlayer($player_count)
    {
        for ($index = 1; $index <= $player_count; $index++) {
            $this->players[] = new Player(readline("Player $index, what's your name? ". PHP_EOL));
        }
    }

    public function registerPinsDown($id, $round)
    {
        $player = $this->players[$id];

        $name = $player->getName();
        $firstThrow = (int) readline("It's your turn $name: what was your first throw? " . PHP_EOL);
        $this->sanitizeInput($firstThrow, $player);
        $throws = $firstThrow;

        if ($firstThrow < 10 || $round == 10) {
            $secondedThrow = (int) readline("What was your second throw? " . PHP_EOL);
            $this->sanitizeInput($secondedThrow, $player);
            $throws = $firstThrow + $secondedThrow;
        }

        if ($throws >= 10) {
            print 'Score cannot be more then 10' . PHP_EOL;
            $this->registerPinsDown($player, $round);
        }

        $player->setLastTwoThrows([
            "first"  => $firstThrow,
            "second" => $secondedThrow ?? ""
        ]);

        $player->setCurrentRound($round);
        $player->setScore();
    }

    public function printStatus()
    {
        $scoreArray = $this->getScoreArray();

        $firstPlaceName = array_search(max($scoreArray), $scoreArray);
        $firstPlaceScore = max($scoreArray);

        arsort($scoreArray);
        $keys = array_keys($scoreArray);
        $secondPlaceScore = $scoreArray[$keys[1]];

        $points = $firstPlaceScore - $secondPlaceScore;

        print "$firstPlaceName is ahead by: $points points!" . PHP_EOL;
    }

    public function getWinner()
    {
        $scoreArray = $this->getScoreArray();

        $winner = array_search(max($scoreArray), $scoreArray);
        print "The game is over. $winner won! Congratulations!" . PHP_EOL;
        exit;
    }

    private function getScoreArray()
    {
        $scoreArray = [];
        foreach ($this->players as $key => $player){
            $scoreArray[$player->getName()] = $player->getScore();
        }

        return $scoreArray;
    }

    private function sanitizeInput($input, $player)
    {
        if (is_numeric($input)) {
            return $input;
        }

        print('Invalid input, please try again.');
        $this->registerPinsDown($player);
    }
}