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
    <div class="wrapper">
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

</body>
</html>