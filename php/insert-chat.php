<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id =mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id =mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message =mysqli_real_escape_string($conn, $_POST['message']);

        if(!empty($message) && !empty($outgoing_id) && !empty($incoming_id) ){
            $sql="INSERT INTO messages (incoming_msg_id, outgoing_msg_id,msg)
            VALUES (?,?,?)";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("sss",$incoming_id,$outgoing_id,$message);
            $result=$stmt->execute();
        }else{
            echo 'sumthin wrong';
        }

    }else{
        header("location: ../login.php");
    }



?>