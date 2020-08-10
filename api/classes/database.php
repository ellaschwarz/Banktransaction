<?php

require_once '../../env/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('../../');
$dotenv->load();

//Connection to database
class DataBase
{
    private $db;
    private $user;
    private $pass;
    private $charset;
    private $dsn;
    private $unix_socket;

    public function connect()
    {
        $this->unix_socket = $_ENV['unix_socket'];
        $this->db = $_ENV['db'];
        $this->user = $_ENV['user'];
        $this->pass = $_ENV['pass'];
        $this->charset = $_ENV['charset'];

        try {
            $dsn = "mysql:unix_socket=$this->unix_socket;dbname=$this->db;charset=$this->charset";
            $pdo = new PDO($dsn, $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
            //Catch error and display error message to client
        } catch (PDOException $e) {
            echo "Unable to connect: ".$e->getMessage();
        }
    }
}
