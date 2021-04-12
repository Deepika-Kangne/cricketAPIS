<?php
require_once('DBconnect.php');

class Matches
{
    private $id;
    private $team_one;
    private $team_two;
    private $team_details;
    private $winner;
    private $looser;
    private $man_of_match;
    private $bowler_of_match;
    private $best_fielder;

    private $tableName = 'matches';
    private $dbConn;

    function setId($id)
    {
        $this->id = $id;
    }
    function getId()
    {
        return $this->id;
    }

    function setTeamOne($team_one)
    {
        $this->team_one = $team_one;
    }
    function getTeamOne()
    {
        return $this->team_one;
    }

    function setTeamTwo($team_two)
    {
        $this->team_two = $team_two;
    }
    function getTeamTwo()
    {
        return $this->team_two;
    }

    function setMatchDesc($team_details)
    {
        $this->team_details = $team_details;
    }
    function getMatchDesc()
    {
        return $this->team_details;
    }
    function setWinner($winner)
    {
        $this->winner = $winner;
    }
    function getWinner()
    {
        return $this->winner;
    }
    function setLooser($looser)
    {
        $this->looser = $looser;
    }
    function getLooser()
    {
        return $this->looser;
    }

    function setManofMatch($man_of_match)
    {
        $this->man_of_match = $man_of_match;
    }
    function getManofMatch()
    {
        return $this->man_of_match;
    }

    function setBowlerofMatch($bowler_of_match)
    {
        $this->bowler_of_match = $bowler_of_match;
    }
    function getBowlerofMatch()
    {
        return $this->bowler_of_match;
    }

    function setBest_fielder($best_fielder)
    {
        $this->best_fielder = $best_fielder;
    }
    function getBest_fielder()
    {
        return $this->best_fielder;
    }

    public function __construct()
    {
        $db = new DbConnect();
        $this->dbConn = $db->connect();
    }

    public function getAllMatches()
    {
        $stmt = $this->dbConn->prepare("SELECT * FROM " . $this->tableName . " m INNER JOIN teams t ON m.team_one = t.id  ");
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
        if (null != $this->getTeamOne()) {
            $sql .=    " country_name = '" . $this->getTeamOne() . "'  ,";
        }

        if (null != $this->getTeamTwo()) {
            $sql .=    " team_name = '" . $this->getTeamTwo() . "'  ,";
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
