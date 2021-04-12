<?php
require_once('Rest.php');
require_once('DBconnect.php');
require_once('Players.php');

class PlayerApiClass extends Rest
{
    public function __construct()
    {
        parent::__construct();
        $db = new DbConnect;
        $this->dbConn = $db->connect();
    }


    public function getAllPlayers()
    {
        $player = new Players;

        if (!$player->getAllPlayers()) {
            $message = 'Failed to insert.';
        } else {
            $message = "List of Players.";
            $data = $player->getAllPlayers();
        }

        $this->returnResponse(SUCCESS_RESPONSE, $data);
    }
}
