<?php
class DBConnection
{

    private $host = 'your_database_host';
    private $username = 'your_database_username';
    private $password = 'your_database_password';
    private $database = 'your_database_name';

    public $conn;

    public function __construct()
    {

        if (!isset($this->conn)) {

            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

            if (!$this->conn) {
                echo 'Cannot connect to database server';
                exit;
            }
        }
    }
    public function __destruct()
    {
        $this->conn->close();
    }
}
