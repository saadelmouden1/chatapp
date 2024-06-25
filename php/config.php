<?php
    // $conn = new mysqli("localhost", "root", "", "chatapp");
    // if(!$conn){
    //     echo "Database connection : ".mysqli_connect_error();
    // }

    $conn = new mysqli("localhost", "root", "", "chatapp");
    if($conn->connect_errno !=0){
        echo "Database connection : ".$conn->connect_error;
    }
?>