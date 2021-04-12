<?php
require_once('DBconnect.php');

class Players
{
    private $id;
    private $country_name;
    private $age;
    private $team;
    private $name;
    private $player_pic;
    private $matches;
    private $highScore;


    private $tableName = 'players';
    private $dbConn;

    function setId($id)
    {
        $this->id = $id;
    }
    function getId()
    {
        return $this->id;
    }
    function setCountryName($country_name)
    {
        $this->country_name = $country_name;
    }
    function getCountryName()
    {
        return $this->country_name;
    }

    function setAge($age)
    {
        $this->age = $age;
    }
    function getAge()
    {
        return $this->age;
    }

    function setTeam($team)
    {
        $this->team = $team;
    }
    function getTeam()
    {
        return $this->team;
    }

    function setName($name)
    {
        $this->name = $name;
    }
    function getName()
    {
        return $this->name;
    }

    function setPlayer_pic($player_pic)
    {
        $this->player_pic = $player_pic;
    }
    function getPlayer_pic()
    {
        return $this->player_pic;
    }

    function setMatches($matches)
    {
        $this->matches = $matches;
    }
    function getMatches()
    {
        return $this->matches;
    }

    function setHighestScore($highScore)
    {
        $this->highScore = $highScore;
    }
    function getHighestScor()
    {
        return $this->highScore;
    }

    public function __construct()
    {
        $db = new DbConnect();
        $this->dbConn = $db->connect();
    }

    public function getAllPlayers()
    {
        $stmt = $this->dbConn->prepare("SELECT * FROM " . $this->tableName . " p INNER JOIN country c ON p.country_name = c.id INNER JOIN teams t ON p.team = t.id ");
        $stmt->execute();
        $countries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $countries;
    }

    public function getCustomerDetailsById()
    {

        $sql = "SELECT 
						c.*
					FROM country c 
					WHERE 
						c.id = :countryId";

        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':countryId', $this->id);
        $stmt->execute();
        $countries = $stmt->fetch(PDO::FETCH_ASSOC);
        return $countries;
    }


    public function insert()
    {

        $sql = 'INSERT INTO ' . $this->tableName . '(id, country_name) VALUES(null, :country_name)';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':country_name', $this->country_name);

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
            $sql .=    " country_name = '" . $this->getName() . "'  ";
        }

        $sql .=    " WHERE id = :countryId";

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
        $stmt = $this->dbConn->prepare('DELETE FROM ' . $this->tableName . ' WHERE id = :countryId');
        $stmt->bindParam(':countryId', $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
