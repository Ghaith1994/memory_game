<?php

require_once 'lib/Game.php';
require_once 'Helpers/GameHandler.php';
require_once 'Helpers/Traits/ApiResponseTrait.php';

class GameController
{
    use ApiResponseTrait;

    public function index()
    {
        $game = new Game();

        include 'Views/home.php';
    }

    public function checkResult()
    {
        if (!isset($_GET['index'])) {
            $this->errorResponse(400,  "index card is required");
        }
        $result = GameHandler::getGame()->uncoverCard($_GET['index']);

        $this->successResponse($result);
    }
}