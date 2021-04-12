<?php
require_once('DBconnect.php');

class Team
{
    private $id;
    private $team_name;
    private $country_name;
    private $tableName = 'teams';
    private $dbConn;

    function setId($id)
    {
        $this->id = $id;
    }
    function getId()
    {
        return $this->id;
    }

    function setName($country_name)
    {
        $this->country_name = $country_name;
    }
    function getName()
    {
        return $this->country_name;
    }

    function setTeam($team_name)
    {
        $this->team_name = $team_name;
    }
    function getTeam()
    {
        return $this->team_name;
    }

    public function __construct()
    {
        $db = new DbConnect();
        $this->dbConn = $db->connect();
    }

    public function getAllTeams()
    {
        $stmt = $this->dbConn->prepare("SELECT * FROM " . $this->tableName . " t INNER JOIN country c ON t.country_name = c.id ");
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
        if (null != $this->getName()) {
            $sql .=    " country_name = '" . $this->getName() . "'  ,";
        }

        if (null != $this->getTeam()) {
            $sql .=    " team_name = '" . $this->getTeam() . "'  ,";
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
