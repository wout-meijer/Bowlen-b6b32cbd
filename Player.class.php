<?php

class player
{
    private int $score = 0;
    private array $lastTwoThrows;
    public array $lastThrow;
    private string $name;
    private int $round;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setScore()
    {
        if ($this->lastTwoThrows['first'] === 10) {
            if ($this->round == 10) {
                $this->score = $this->lastTwoThrows['first'] + $this->lastTwoThrows['second'] + 10;
            } else {
                $this->score = $this->lastTwoThrows['first'] + 10;
            }
            return;
        } elseif ($this->lastTwoThrows['first'] + $this->lastTwoThrows['second'] == 10) {
            $this->score = $this->lastTwoThrows['first'] + $this->lastTwoThrows['second'] + 5;
            return;
        }

        $this->score = $this->score + $this->lastTwoThrows['first'] + $this->lastTwoThrows['second'];
    }

   public function getScore()
    {
        return $this->score;
    }

    public function setLastTwoThrows($throws)
    {
       $this->lastTwoThrows = $throws;
    }

    public function getLastTwoThrows()
    {
        return $this->lastTwoThrows;
    }

    public function setLastThrow($throw) {
        return $this->lastThrow = $throw;
    }

    public function getLastThrow()
    {
        return $this->lastThrow;
    }

    public function setCurrentRound($round)
    {
        return $this->round = $round;
    }
}