<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
?>
<?php
include_once 'header.php';

?>
<body>
     <div class="wrapper  na">
        <section class="users">
            <header>
                <?php
                include_once "php/config.php";
                $sql="SELECT * FROM users WHERE unique_id ={$_SESSION['unique_id']}";
                $stmt= $conn->prepare($sql);
                $stmt->execute();
                $result=$stmt->get_result();
                if($result->num_rows >0){
                    $user = $result->fetch_assoc();
                }


                ?>
                <div class="content">
                    <img src="php/images/<?php echo $user['img']?>" alt="">
                    <div class="details">
                        <span><?php echo $user['fname']." ".$user['lname']?></span>
                        <p><?php echo $user['status']?></p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $user['unique_id']?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
               
            
            </div>
            
        </section>

    </div>
    <script src="javascript\user.js"></script>
    <div class="wrapper nw">
        <section class="chat-area">
            <header>
            <?php
                include_once "php/config.php";
                $user_id=mysqli_real_escape_string($conn,$_GET['user_id']);
                $sql="SELECT * FROM users WHERE unique_id ={$user_id}";
                $stmt= $conn->prepare($sql);
                $stmt->execute();
                $result=$stmt->get_result();
                if($result->num_rows >0){
                    $user = $result->fetch_assoc();
                }


                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="php/images/<?php echo $user['img']?>" alt="">
                    <div class="details">
                        <span><?php echo $user['fname']." ".$user['lname']?></span>
                        <p><?php echo $user['status']?></p>
                    </div>
                
            </header>
            <div class="chat-box">
                <!-- <div class="chat outgoing">
                    <div class="details">
                        <p>wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="img.jpg" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div> -->
               
            </div>
            <form action="" class="typing-area">
                <input type="text" name='outgoing_id' value="<?php echo $_SESSION['unique_id'];?>" hidden >
                <input type="text" name="incoming_id" value="<?php echo $user_id;?>"  hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here...">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
           
            
        </section>

    </div>

    <script src="javascript/chat.js"></script>
    
</body>
</html>