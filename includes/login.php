<?php
session_start();
include 'dbconnect.php';
    if(isset($_POST['submit_login'])){
        if(!empty($_POST['email']) && !empty($_POST['password'])){
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = $_POST['password'];
            $query = "SELECT * FROM users WHERE email='$email' AND username='$username' AND password = SHA1('$password')";
            $result = mysqli_query($conn, $query);
            while($rows = mysqli_fetch_assoc($result)){
                if(mysqli_num_rows($result) == 1){
                    $_SESSION['expire']= time();
                    $_SESSION['logged_user']=$rows['username'];
                    $_SESSION['role']=$rows['role'];
                    $_SESSION['email']=$rows['email'];
         
                    header('Location:../index.php');
                }else {
                    header('Location:../index.php');
                } //end if
               
            }//end while
             
        }
    }
?>