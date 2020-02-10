<?php

include 'ScoreBoard.class.php';

class BowlingGame {

    private object $scoreBoard;
    private int $player_count;

    function __construct($player_count)
    {
        $this->player_count = $player_count;
        $this->scoreBoard  = new ScoreBoard();
    }

    public function start()
    {
        $this->scoreBoard->addPlayer($this->player_count);

        foreach(range(1, 10) as $round) {
           print "Round: " . $round . PHP_EOL;
            foreach(array_keys(range(1, $this->player_count)) as $key) {

               $this->scoreBoard->registerPinsDown($key, $round);

                if ($key+1 == $this->player_count) {
                    $this->scoreBoard->printStatus();
                }
            }
        }

        $this->scoreBoard->getWinner();
    }
}