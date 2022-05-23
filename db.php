<?php 
require_once __DIR__ . '/config.php';

Class Database {
    private $user = "root";
    private $host = "localhost";
    private $pass = "";
    private $db = "eugene";
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect( Config::DB['host'], Config::DB['user'], Config::DB['pass'], Config::DB['db_name'] );
    }

    /**
     * Get DB Connect
     * 
     * @return false | object
     */
    public function getConnect() {
        return $this->conn;
    }

    /**
     * Get database results
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return array
     */
    public function select( $query, $paramType = "", $paramArray = array() ) {
        $stmt = $this->conn->prepare( $query );

        if ( ! empty( $paramType ) && ! empty( $paramArray ) ) {
            $this->bindQueryParams( $stmt, $paramType, $paramArray );
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ( $result->num_rows > 0 ) {
            while ( $row = $result->fetch_assoc() ) {
                $resultset[] = $row;
            }
        }

        if ( ! empty($resultset ) ) {
            return $resultset;
        }
    }

    /**
     * Insert
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return int
     */
    public function insert( $query, $paramType, $paramArray ) {
        $stmt = $this->conn->prepare( $query) ;
        $this->bindQueryParams( $stmt, $paramType, $paramArray );

        $stmt->execute();
        $insertId = $stmt->insert_id;
        return $insertId;
    }

    /**
     * Execute query
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     */
    public function execute( $query, $paramType = "", $paramArray = array() ) {
        $stmt = $this->conn->prepare( $query );

        if ( ! empty( $paramType ) && ! empty( $paramArray ) ) {
            $this->bindQueryParams( $stmt, $paramType, $paramArray );
        }
        $stmt->execute();
    }

    /**
     * 1. Prepares parameter binding
     * 2. Bind prameters to the sql statement
     *
     * @param string $stmt
     * @param string $paramType
     * @param array $paramArray
     */
    public function bindQueryParams( $stmt, $paramType, $paramArray = array() ) {
        $paramValueReference[] = & $paramType;
        for ($i = 0; $i < count($paramArray); $i ++) {
            $paramValueReference[] = & $paramArray[$i];
        }
        call_user_func_array( array(
            $stmt,
            'bind_param'
        ), $paramValueReference );
    }

    /**
     * To get database results
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return Int
     */
    public function getRecordCount( $query, $paramType = "", $paramArray = array() ) {
        $stmt = $this->conn->prepare( $query );
        if ( ! empty($paramType) && ! empty( $paramArray ) ) {
            $this->bindQueryParams( $stmt, $paramType, $paramArray );
        }
        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;

        return $recordCount;
    }
}
?>