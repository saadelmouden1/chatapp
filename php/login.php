<?php
        session_start();
        include_once "config.php";


        
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);

        if(!empty($email) && !empty($password)){
            //let's check users entred email & password matched to database any table row email and password
            $sql ='SELECT * FROM users WHERE email=? AND password =?';
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("ss",$email, $password);
            $stmt->execute();
            $result=$stmt->get_result();
            if($result->num_rows >0){//if users credentials matched
                $status="Active now";
               
                
                $user =$result->fetch_assoc();

                $sql2="UPDATE users SET status =? where unique_id=?";
                $stmt =$conn->prepare($sql2);
                $stmt->bind_param('ss',$status,$user['unique_id']);
                $resp=$stmt->execute();
                if($resp){
                    $_SESSION['unique_id']=$user['unique_id'];
                echo'success';

                }

                
            }else{
                echo'Email r Password is incorrect!';
            }
        }else{
            echo"all input fields are required";
        }
?>
