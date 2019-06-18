<?php

include_once 'connection.php';

abstract class BasicDAO {
    
    private static $connection = NULL;
    
    public function connectIfNeeded() {
        if (is_null(self::$connection)) {
            self::$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
            if (mysqli_connect_errno()) {
                throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
            }
            mysqli_select_db(self::$connection, DB_NAME);   
        } else if (mysqli_connect_errno()) {
            $this->restartConnection();
        } else if (!mysqli_ping(self::$connection)) {
            $this->restartConnection();
        }
    }
    
    public function executeSentence($sql) {
        return mysqli_query(self::$connection, $sql);
    }
    
    public function selectLastInsertId() {
        return mysqli_insert_id(self::$connection);
    }
    
    public function getError() {
        return self::$connection->error;
    }
    
    private function restartConnection() {
        self::$connection = NULL;
        $this->connectIfNeeded();
    }
}