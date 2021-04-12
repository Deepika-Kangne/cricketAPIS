<?php
require_once('Rest.php');
require_once('DBconnect.php');
require_once('Teams.php');

class TeamApiClass extends Rest
{
    public function __construct()
    {
        parent::__construct();
        $db = new DbConnect;
        $this->dbConn = $db->connect();
    }


    public function getTeams()
    {
        $team = new Team;

        if (!$team->getAllTeams()) {
            $message = 'Failed to insert.';
        } else {
            $message = "List of Teams.";
            $data = $team->getAllTeams();
        }

        $this->returnResponse(SUCCESS_RESPONSE, $data);
    }
}
