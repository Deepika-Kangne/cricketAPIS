<?php
require_once('DBconnect.php');

class Venue
{
    private $id;
    private $venue_name;
    private $venue_desc;
    private $venue_location;
    private $venue_img;

    private $tableName = 'venue';
    private $dbConn;

    function setId($id)
    {
        $this->id = $id;
    }
    function getId()
    {
        return $this->id;
    }

    function setVenueName($venue_name)
    {
        $this->venue_name = $venue_name;
    }
    function getVenueName()
    {
        return $this->venue_name;
    }

    function setVenueDesc($venue_desc)
    {
        $this->venue_desc = $venue_desc;
    }
    function getVenueDesc()
    {
        return $this->venue_desc;
    }

    function setVenueLoc($venue_location)
    {
        $this->venue_location = $venue_location;
    }
    function getVenueLoc()
    {
        return $this->venue_location;
    }

    function setVenueImg($venue_img)
    {
        $this->venue_img = $venue_img;
    }
    function getVenueImg()
    {
        return $this->venue_img;
    }

    public function __construct()
    {
        $db = new DbConnect();
        $this->dbConn = $db->connect();
    }

    public function getAllVenues()
    {
        $stmt = $this->dbConn->prepare("SELECT * FROM " . $this->tableName . "");
        $stmt->execute();
        $countries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $countries;
    }

    public function getTeamDetailsById()
    {

        $sql = "SELECT 
						c.*
					FROM country c 
					WHERE 
						c.id = :teamId";

        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':teamId', $this->id);
        $stmt->execute();
        $countries = $stmt->fetch(PDO::FETCH_ASSOC);
        return $countries;
    }


    public function insert()
    {

        $sql = 'INSERT INTO ' . $this->tableName . '(id, country_name,team_name) VALUES(null, :country_name, :team_name)';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':country_name', $this->country_name);
        $stmt->bindParam(':team_name', $this->team_name);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {

        $sql = "UPDATE $this->tableName SET";
        if (null != $this->getVenueName()) {
            $sql .=    " country_name = '" . $this->getVenueName() . "'  ,";
        }

        if (null != $this->getVenueDesc()) {
            $sql .=    " team_name = '" . $this->getVenueDesc() . "'  ,";
        }

        $sql .=    " WHERE id = :teamId";

        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':countryId', $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $stmt = $this->dbConn->prepare('DELETE FROM ' . $this->tableName . ' WHERE id = :teamId');
        $stmt->bindParam(':teamId', $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
