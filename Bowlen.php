<?php

include 'BowlingGame.class.php';

class bowlen
{
    public function welcome()
    {
        $player_count = (int) readline("Welcome to the bowling game! How many people want to play: " . PHP_EOL);

        if (! empty($player_count)) {
            $game = new bowlingGame($player_count);
            $game->start();
        } else {
            print 'Invalid input';
        }
    }
}

$bowling = new bowlen;
$bowling->welcome();


