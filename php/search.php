<?php
    session_start();
    include_once "config.php";
    $outgoing_id=$_SESSION['unique_id'];

    $searchTerm =mysqli_real_escape_string($conn,$_POST['searchTerm']);
    $output="";
    $sql ="SELECT * FROM users WHERE NOT unique_id={$_SESSION['unique_id']} AND (fname LIKE ? OR lname LIKE ?)";
    $sr="%$searchTerm%";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$sr,$sr);
    $stmt->execute();
    $result=$stmt->get_result();
    
    if($result->num_rows > 0){
        include "data.php";
    }else{
        $output.="No user found related to your search term";
    }
    echo $output;

?>