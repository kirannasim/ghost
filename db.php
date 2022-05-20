<?php 
Class Database {
    private $user;
    private $host;
    private $pass;
    private $db;

    public function __construct() {
        $this->user = "root";
        $this->host = "localhost";
        $this->pass = "";
        $this->db = "eugene";
    }

    public function connect() {
        $conn = mysqli_connect( $this->host, $this->user, $this->pass, $this->db );
        return $conn;
    }
}
?>