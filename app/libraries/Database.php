<?php

/*
* PDO databse class
* Connect to database
* Create prepared statements
* Bind values
* Return rows and results
*/

class Database {
    // DB connection parameters
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbName = DB_NAME;
    // Database connection instance variable
    private $dbHandler;
    // Statement variable to query database & error handler
    private $stmt;
    private $error;

    public function __construct() {
        // initialize dsn
         $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;

         // PDO options
         $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO instance 
        try {

            $this->dbHandler = new PDO($dsn, $this->user,$this->password,$options);

        }catch(PDOException $e) {

            $this->error = $e->getMessage();
            echo $this->error;

        }

    }

    public function query($sql) {
        //Prepare statement with SQL query
        $this->stmt = $this->dbHandler->prepare($sql);
    }

    // Bind the values
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute() {
        return $this->stmt->execute();
    }

    // Get the result set as array of objects
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount() {
        return $this->stmt->rowCount();
    }
    
}