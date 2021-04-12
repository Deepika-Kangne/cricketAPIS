<?php
require_once('DBconnect.php');

class Country
{
    private $id;
    private $country_name;

    private $tableName = 'country';
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

    public function __construct()
    {
        $db = new DbConnect();
        $this->dbConn = $db->connect();
    }

    public function getAllCountries()
    {
        $stmt = $this->dbConn->prepare("SELECT * FROM " . $this->tableName);
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
