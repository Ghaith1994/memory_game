<?php


class GameHandler
{
    private $game;

    /**
     * @return mixed
     */
    public static function getGame()
    {
        return $_SESSION['game'];
    }

    /**
     * @param mixed $game
     */
    public static function setGame($game)
    {
        $_SESSION['game'] = $game;
    }
}