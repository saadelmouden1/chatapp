<?php
    session_start();


    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){
            $status= "Offline now";

            $sql="UPDATE users SET status =? where unique_id=?";
            $stmt =$conn->prepare($sql);
            $stmt->bind_param('ss',$status,$logout_id);
            $resp=$stmt->execute();

            if($resp){
                session_unset();
                session_destroy();
                header("location:../login.php");
            }
        }else{
            header("location:../users.php");
        }
    }else{
        header("location:../login.php");
    }

?>
