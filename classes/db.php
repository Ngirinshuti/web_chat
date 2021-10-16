<?php
//CONNECTION CLASS

class Con
{
    protected $server;
    protected $user;
    protected $database;
    protected $password;

    public function __construct()
    {
        $this->server   = "localhost";
        $this->user     = "root";
        $this->database = "project2";
        $this->password = "";
    }

    public function create_connection()
    {
        try {
            $conn = new PDO(
                "mysql:host=$this->server;dbname=$this->database",
                $this->user,
                $this->password
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            return ['Error' => '<big>' . $e->getMessage() . '</big>'];
        }
    }
}