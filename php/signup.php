<?php

session_start();
    include_once "config.php";


    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);


   

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        //let's check user email is valid or not
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){//if emial is valide
            //let's check that email already exist in the data base or rno
            
            $sql = "SELECT email FROM users WHERE email=?"; // SQL with parameters
            $stmt = $conn->prepare($sql); 
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result= $stmt->get_result(); // get the mysqli result
          
            // $sql =mysqli_query($conn, "SELECT email FROM users WHERE email ='{$email}'");

            if($result->num_rows > 0){

                echo"$email - This email already exist  ";
            }else{
                //let's check user upload file or not
                if(isset($_FILES['image'])){//if file id uploaded
                    $img_name= $_FILES['image']['name'];//getting user uploaded img name
                    $img_type = $_FILES['image']['type'];//getting user upload img type
                    $tmp_name = $_FILES['image']['tmp_name'];//this temprory name is used to save/move foile in our folder

                    //let's explode image and get the last extention like jpg png
                    $img_explode = explode('.',$img_name);
                    $img_ext= end($img_explode);//here we get extention of an user upload img file

                    $extentions=['png','jpeg','jpg']; //these are some valid img ext and we've store them in array
                    if(in_array($img_ext,$extentions) === true){//if user uploaded img ext matched with any array extentions
                        $time =time(); //this will return us curreent timle...
                                        //we need this time becouse xhen you uploading user img to in our folder we rename user file with current time
                                        //so all the imag file will have a unique nam
                    //let's move the user uploaded img to our particular folder
                    $new_img_name =$time.$img_name;

                    if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                        $status ="Active now"; //once user signed up then his status will be active now
                        $random_id =rand(time(),10000000);//creating random id for user

                        //let's insert all user data inside table
                        $sql2="INSERT INTO users (unique_id,fname,lname,email,password,img,status)
                        VALUES (?,?,?,?,?,?,?)";
                        $stmt=$conn->prepare($sql2);
                        $stmt->bind_param("sssssss",$random_id,$fname,$lname,$email,$password,$new_img_name,$status);
                        $res=$stmt->execute();
                        if($res){
                            $sql3="SELECT * FROM users WHERE email=?";
                            $stmt = $conn->prepare($sql3); 
                            $stmt->bind_param("s", $email);
                            $stmt->execute();
                            $result = $stmt->get_result(); // get the mysqli result
                            
                            
                            if($result->num_rows> 0){
                                $user =$result->fetch_assoc();
                                
                                $_SESSION['unique_id']=$user['unique_id'];
                                echo 'success';
                            }else{
                                echo'ttt';
                            }
                            
                        }else{
                            echo 'Somthing went wrong!';
                        }


                    }
                 }else{
                        echo"Please select an Imge fiel!";
                 }
                }
            }

        }else{
            echo"$email - This is not a valid email!";
        }


    }else{
        echo "all nput are required";
    }
?>