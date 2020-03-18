<?php


function connection(){
    
    $host = "localhost";
    $username = "root";
    $password = "Kaizale@2018";
    $database = "student_system";

    $con = new mysqli($host, $username, $password, $database);

    date_default_timezone_set("Asia/Manila");

    //MySQLi Function: connect_error 
    if($con->connect_error){
        echo $con->connect_error;
    }
    else{        
        return $con;        
    }

}

?>
  