<?php

while($user =$result->fetch_assoc()){
    $sql2="SELECT * FROM messages
             WHERE ( incoming_msg_id =? or outgoing_msg_id =?)
            and  ( incoming_msg_id =? or outgoing_msg_id =?) ORDER BY msg_id desc LIMIT 1";
            $unique_id=$user['unique_id'];


            $stmt=$conn->prepare($sql2);
            $stmt->bind_param("ssss",$unique_id,$unique_id,$outgoing_id,$outgoing_id);
            $stmt->execute();
            $resul=$stmt->get_result();
            $row2=$resul->fetch_assoc();
            if($resul->num_rows >0){

                $res=$row2['msg'];
                $otg=$row2['outgoing_msg_id'];

            }else{
                $res="No message available";
                $otg="";
            }
            (strlen($res)> 28) ? $msg =substr($res, 0, 28).'...' : $msg = $res;
            
           
            ($outgoing_id == $otg)? $you='You: ' : $you="";

            ($user['status'] =='Offline now' )? $offline='offline' : $offline='';

             
        $output.= ' <a href="chat.php?user_id='.$user['unique_id'].'">
        <div class="content">
            <img src="php/images/'.$user['img'].'" alt="">
            <div class="details">
                <span>'.$user['fname']." ".$user['lname'].'</span>
                <p>'.$you.$msg.'</p> 
            </div>
        </div>
        <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
    </a>'
    ;
    
   
}


?>