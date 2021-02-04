<?php

class DatabaseConnection{
    //instance variable for database connection
    private $server_name;
    private $username_name;
    private $password;
    private $database_name;
    private $charset;

    //function for connecting database
    public function connect(){
        $this->server_name   = "localhost";
        $this->username_name = "u689581850_sms";
        $this->password = "Sms12345678";
        $this->database_name = "u689581850_sms";
        $this->charset = "utf8mb4";
       
        //error handling 
        try{
            $databasePath = "mysql:host=".$this->server_name .";dbname=".$this->database_name.";charset=".$this->charset;
            $pdo = new PDO($databasePath,$this->username_name, $this->password);  
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage();
        }
        
    }

}
?>