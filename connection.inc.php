
<?php
class DbConnect
{
    private $server = 'localhost';
    private $dbname = 'cricket_db';
    private $user = 'root';
    private $pass = '';

    public function connect()
    {
        try {

            $con = mysqli_connect($this->server, $this->user, $this->pass, $this->dbname);
            return $con;
        } catch (\Exception $e) {
            echo "Database Error: " . $e->getMessage();
        }
    }
}
$db = new DbConnect;
$db->connect();
