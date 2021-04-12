<?php
class DbConnect
{
    private $server = 'localhost';
    private $dbname = 'cricketdb';
    private $user = 'root';
    private $pass = '';

    //$con = mysqli_connect('localhost', 'id12770049_id12770049_root', 'Deepiroot@1234', 'id12770049_cricket_db');

    public function connect()
    {
        try {
            $conn = new PDO('mysql:host=' . $this->server . ';dbname=' . $this->dbname, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\Exception $e) {
            echo "Database Error: " . $e->getMessage();
        }
    }
}
$db = new DbConnect;
$db->connect();
