<?php
require_once('Rest.php');
require_once('DBconnect.php');
require_once('matches.php');

class MatchesApiClass extends Rest
{
    public function __construct()
    {
        parent::__construct();
        $db = new DbConnect;
        $this->dbConn = $db->connect();
    }


    public function getAllMatches()
    {
        $player = new Matches;

        if (!$player->getAllMatches()) {
            $message = 'Failed to insert.';
        } else {
            $message = "List of Players.";
            $data = $player->getAllMatches();
        }

        $this->returnResponse(SUCCESS_RESPONSE, $data);
    }
}
