<?php
require_once('Rest.php');
require_once('DBconnect.php');
require_once('Country.php');

class countryApiClass extends Rest
{
    public function __construct()
    {
        parent::__construct();
        $db = new DbConnect;
        $this->dbConn = $db->connect();
    }

    public function addCountry()
    {

        $name = $this->validateParameter('name', $this->param['name'], STRING, false);


        try {
            $token = $this->getBearerToken();
            $payload = JWT::decode($token, SECRET_KEY, ['HS256']);
            $stmt = $this->dbConn->prepare("SELECT * FROM users WHERE id = :userId ");
            $stmt->bindParam(":userId", $payload->userId);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!is_array($user)) {
                $this->returnResponse(INVALID_USER_PASS, "The user is not found in our database.");
            }

            if ($user['active'] == 0) {
                $this->returnResponse(USER_NOT_ACTIVE, "User is not activated. Please contact to admin.");
            }
        } catch (Exception $e) {
            $this->throwError(ACCESS_TOKEN_ERRORS, $e->getMessage());
        }


        $country = new Country;
        $country->setName($name);

        if (!$country->insert()) {
            $message = 'Failed to insert.';
        } else {
            $message = "Inserted successfully.";
        }

        $this->returnResponse(SUCCESS_RESPONSE, $message);
    }

    public function getCountries()
    {

        //$name = $this->validateParameter('name', $this->param['name'], STRING, false);


        // try {
        //     $token = $this->getBearerToken();
        //     $payload = JWT::decode($token, SECRET_KEY, ['HS256']);
        //     $stmt = $this->dbConn->prepare("SELECT * FROM users WHERE id = :userId ");
        //     $stmt->bindParam(":userId", $payload->userId);
        //     $stmt->execute();
        //     $user = $stmt->fetch(PDO::FETCH_ASSOC);
        //     if (!is_array($user)) {
        //         $this->returnResponse(INVALID_USER_PASS, "The user is not found in our database.");
        //     }

        //     if ($user['active'] == 0) {
        //         $this->returnResponse(USER_NOT_ACTIVE, "User is not activated. Please contact to admin.");
        //     }
        // } catch (Exception $e) {
        //     $this->throwError(ACCESS_TOKEN_ERRORS, $e->getMessage());
        // }


        $country = new Country;

        if (!$country->getAllCountries()) {
            $message = 'Failed to insert.';
        } else {
            $message = "List of Countries.";
            $data = $country->getAllCountries();
        }

        $this->returnResponse(SUCCESS_RESPONSE, $data);
    }
}
