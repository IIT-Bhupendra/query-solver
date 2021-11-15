<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '_dbconnect.php';
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE `user_id`='$email' ";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
        $row = mysqli_fetch_assoc($result);

        if(password_verify($pass, $row['user_password'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['fname'] = $row['user_first_name'];
            $_SESSION['lname'] = $row['user_last_name'];
            $_SESSION['sno'] = $row['user_serial_number'];
            header("location: /index.php");
            // echo "Success".$_SESSION['fname']." ".$_SESSION['lname'];
            exit;
        }  
        else{
            header("location: /index.php?pass_error=true");
            exit;
        }     
    }
    header("location: /index.php?no_account=true");
}

// header("location: /forum_1/index.php");
?>