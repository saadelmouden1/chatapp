<?php
     session_start();
     if(isset($_SESSION['unique_id'])){
         include_once "config.php";
         $outgoing_id =mysqli_real_escape_string($conn, $_POST['outgoing_id']);
         $incoming_id =mysqli_real_escape_string($conn, $_POST['incoming_id']);
      
        $output="";

        if(!empty($outgoing_id) && !empty($incoming_id) ){
            $sql="SELECT * FROM messages
            LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
             WHERE (outgoing_msg_id =? AND incoming_msg_id =?)
            OR  (outgoing_msg_id =? AND incoming_msg_id =?) ORDER BY msg_id";

            $stmt=$conn->prepare($sql);
            $stmt->bind_param("ssss",$outgoing_id,$incoming_id,$incoming_id,$outgoing_id);
            $stmt->execute();
            $result=$stmt->get_result();
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $otg=print_r($row['outgoing_msg_id'] ,true);
                    if($otg === $outgoing_id){
                        $output.='<div class="chat outgoing">
                                    <div class="details">
                                        <p>'.$row['msg'].'</p>
                                    </div>
                                </div>';
                    }else{
                        $output.='<div class="chat incoming">
                                    <img src="php/images/'.$row['img'].'" alt="">
                                    <div class="details">
                                        <p>'.$row['msg'].'</p>
                                    </div>
                                </div>';
                    }
                }
                echo $output;
            }
        }else{
            echo 'sumthin wrong';
        }

     }else{
        header("location: ../login.php");
    }

?>