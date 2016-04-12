<?php
$config   = parse_ini_file('../../config.ini');
$hostname = $config['hostname'];
$username = $config['username'];
$password = $config['password'];
$dbname   = $config['dbname'];

class Database
{
    //Declare connection string
    public $connection;
    //Connect with database for mysql database
    public function __construct($host, $user, $pass, $db)
    {
        $this->connection = new mysqli($host, $user, $pass);
        //Check Connection
        if ($this->connection->connect_errno) {
            die("Connection Fail " . $this->connection->connect_error);
        } else {
            //echo "Connection is ok <br>";
        }
        $this->connection->select_db($db);
    }
    //Fetch data by accepting table name and columns(1 dimentional array) name
    public function fetch($table, array $columns)
    {
        //Append each element of val_cols associative array 
        $i = 0;
        foreach ($columns as $key => $value) {
            $exp[$i] = $key . " = '" . $value . "'";
            $i++;
        }
        
        $Stexp = implode(" AND ", $exp);
        $result  = $this->connection->query("SELECT * FROM $table WHERE $Stexp ");
        
        if ($this->connection->errno) {
            die("Fail Select " . $this->connection->error);
        }
        //return tow dimentional array as required columns result
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    //Insert Data within table by accepting TableName and Table column
    public function insert($tblname, array $val_cols)
    {
        $keysString = implode(", ", array_keys($val_cols));
        
        $i = 0;
        foreach ($val_cols as $key => $value) {
            $StValue[$i] = "'" . $value . "'";
            $i++;
        }
        
        $StValues = implode(", ", $StValue);
        
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        //Perform Insert operation
        if ($this->connection->query("INSERT INTO $tblname ($keysString) VALUES ($StValues)") === TRUE) {
            echo "New record has been inserted successfully!";
        } else {
            echo "Error " . $this->connection->error;
        }
    }
    //Delete data form table; Accepting Table Name and Keys=>Values as associative array
    public function delete($tblname, array $val_cols)
    {
        //Append each element of val_cols associative array 
        $i = 0;
        foreach ($val_cols as $key => $value) {
            $exp[$i] = $key . " = '" . $value . "'";
            $i++;
        }
        
        $Stexp = implode(" AND ", $exp);
        
        //Perform Delete operation
        if ($this->connection->query("DELETE FROM $tblname WHERE $Stexp") === TRUE) {
            if (mysqli_affected_rows($this->connection)) {
                echo "Record has been deleted successfully";
            } else {
                echo "The Record you want to delete is no loger exists";
            }
        } else {
            echo "Error to delete" . $this->connection->error;
        }
    }
    //Update data within table; Accepting Table Name and Keys=>Values as associative array
    public function update($tblname, array $set_val_cols, array $cod_val_cols)
    {
        //append set_val_cols associative array elements 
        $i = 0;
        foreach ($set_val_cols as $key => $value) {
            $set[$i] = $key . " = '" . $value . "'";
            $i++;
        }
        
        $Stset = implode(", ", $set);
        
        //append cod_val_cols associative array elements
        $i = 0;
        foreach ($cod_val_cols as $key => $value) {
            $cod[$i] = $key . " = '" . $value . "'";
            $i++;
        }
        
        $Stcod = implode(" AND ", $cod);
        echo "UPDATE $tblname SET $Stset WHERE $Stcod";
        //Update operation
        if ($this->connection->query("UPDATE $tblname SET $Stset WHERE $Stcod") === TRUE) {
            if (mysqli_affected_rows($this->connection)) {
                echo "Record updated successfully";
            } else {
                echo "The Record you want to updated is no longer exists";
            }
        } else {
            echo "Error to update" . $this->connection->error;
        }
    }
} //End of class Database
$obj = new Database($hostname, $username, $password, $dbname);
