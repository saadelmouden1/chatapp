<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: ../login.php");
    }

    include 'config.php';
    $outgoing_id=$_SESSION['unique_id'];

    $sql="SELECT * FROM users WHERE NOT unique_id={$_SESSION['unique_id']}";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $result=$stmt->get_result();

    $output="";

    if(mysqli_num_rows($result) ==0){
        $output.="No users are aailable to chat";
    }elseif(mysqli_num_rows($result) > 0){
       include "data.php";
    }
    echo $output;


?>