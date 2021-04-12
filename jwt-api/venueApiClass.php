<?php
require_once('Rest.php');
require_once('DBconnect.php');
require_once('venue.php');

class VenueApiClass extends Rest
{
    public function __construct()
    {
        parent::__construct();
        $db = new DbConnect;
        $this->dbConn = $db->connect();
    }


    public function getAllVenues()
    {
        $team = new Venue;

        if (!$team->getAllVenues()) {
            $message = 'Failed to insert.';
        } else {
            $message = "List of Venue.";
            $data = $team->getAllVenues();
        }

        $this->returnResponse(SUCCESS_RESPONSE, $data);
    }
}
