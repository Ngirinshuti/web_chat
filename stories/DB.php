<?php
// DB connection file

/**
 * Undocumented class
 */
class DB
{
    protected string $server;
    protected string $user;
    protected string $database;
    protected string $password;

    /**
     * Initialize databse info
     *
     * @param string $server   database server or host
     * @param string $user     database user
     * @param string $database database name
     * @param string $password database password
     *
     * @return void
     */
    public function __construct(string $server = "localhost", string $user = "root", string $database = "project2", string $password = "")
    {
        $this->server   = $server;
        $this->user     = $user;
        $this->database = $database;
        $this->password = $password;
    }

    /**
     * Start database connection
     *
     * @return \PDO
     */
    public function createConnection()
    {
        try {
            $conn = new \PDO(
                "mysql:host=$this->server;dbname=$this->database",
                $this->user,
                $this->password
            );

            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (\PDOException $e) {
            return ['Error' => '<big>' . $e->getMessage() . '</big>'];
        }
    }

    /**
     * Creates a new database connection
     *
     * @return \PDO
     */
    public static function conn()
    {
        return (new DB())->createConnection();
    }
}
