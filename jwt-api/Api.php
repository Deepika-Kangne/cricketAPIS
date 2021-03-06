<?php
require_once('Rest.php');
require_once('DBconnect.php');

class Api extends Rest
{
    public function __construct()
    {
        parent::__construct();
        $db = new DbConnect;
        $this->dbConn = $db->connect();
    }

    public function generateToken()
    {
        $email = $this->validateParameter('email', $this->param['email'], STRING);
        $pass = $this->validateParameter('pass', $this->param['pass'], STRING);
        try {
            $stmt = $this->dbConn->prepare("SELECT * FROM users WHERE name = :email AND password = :pass");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pass", $pass);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!is_array($user)) {
                $this->returnResponse(INVALID_USER_PASS, "Email or Password is incorrect.");
            }

            if ($user['active'] == 0) {
                $this->returnResponse(USER_NOT_ACTIVE, "User is not activated. Please contact to admin.");
            }

            $paylod = [
                'iat' => time(),
                'iss' => 'localhost',
                'exp' => time() + (15 * 60),
                'userId' => $user['id']
            ];

            $token = JWT::encode($paylod, SECRET_KEY);

            $data = ['token' => $token];
            $this->returnResponse(SUCCESS_RESPONSE, $data);
        } catch (Exception $e) {
            $this->throwError(JWT_PROCESSING_ERROR, $e->getMessage());
        }
    }
}
