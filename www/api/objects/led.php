<?php
class Led{

    // database connection and table name
    private $conn;
    private $table_name = "led";

    // object properties
    public $id;
    public $status;
    public $time;
    public $tdate;
    //prova
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
