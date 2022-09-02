<?php
    function db_connect()
    {
        $server_name = "localhost";
        $db_username = "root";
        $db_password = "root"; //for MAC users the password by default is "root"
        $db_name = "blog";

        $conn = new mysqli($server_name, $db_username, $db_password, $db_name);
        
        if($conn->connect_error)
        {
            die("Unable to connect to the database " . $conn->connect_error);
        }else {
            return $conn;
        }
    } 
?>