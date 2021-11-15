<?php

$showError = "false";
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '_dbconnect.php';
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $phone = $_POST['phone'];

    $sql = "SELECT * FROM `users` WHERE `user_id`='$email' OR `user_phone`='$phone' ";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);

    if($num > 0){
        $showError = "Entered Email Address or Phone Number is already in use.";
    }
    else{
        if($password==$cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_first_name`, `user_last_name`, `user_id`, `user_password`, `user_phone`, `user_entry`) VALUES ('$fname', '$lname', '$email', '$hash', '$phone', current_timestamp());";
            $result = mysqli_query($conn,$sql);
            if($result){
                $showAlert = true;
                header("location: /index.php?signupsuccess=true");
                exit();
            }           
        }
        $showError = "Passwords did not matched";
    }
    header("location: /index.php?signupsuccess=false&error=$showError");
}


?>