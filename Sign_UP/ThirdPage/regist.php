<?php
session_start();
include("../../connection/connection.php");
include("../../Functions/Functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // something was posted
   $username    = $_POST['username'];
   $password = $_POST['password'];
   $Fname       = $_POST['Fname'];
   $Lname       = $_POST['Lname'];
   $Nationality = $_POST['Nationality'];
   $phone       = $_POST['phone'];
   $date        = $_POST['date'];
   $email       = $_POST['email'];
   $gender      = $_POST['gender'];
   
   if(!empty($username)&&!empty($password)&&!empty($phone)&&!empty($date)&&!empty($email)&&!empty($gender) && !is_numeric($username)&&!is_numeric($password)&&!is_numeric($email)&&!is_numeric($gender)&&!is_numeric($Nationality))
   {
        //save to database
        $user_id = random_num(20);
        $query = "insert into users(user_id,username,password,phone,email,gender,nationality,Bdate,Fname,Lname) values('$user_id','$username','$password','$phone','$email','$gender','$Nationality','$date','$Fname','$Lname')";
        mysqli_query($con,$query);
       header('Location:../../Log_in/login.php');
       die();
    }
   else
   {
        echo '<script>alert("Please Enter Valid Information!")</script>';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="regist.CSS">
    <link rel="website icon" type="png" href="../../home/imgs/Logo.png">
    <title>Registration</title>
</head>
<body>
    <div class="top">
        <h1>Sign Up</h1>
    </div>
    
    <div class="regist_part">
        <form method="POST" class="container">
            <div class="row">
                <input type="text" name="username" placeholder="user_name20" required name="username">
                <input type="text" placeholder="First Name" required name="Fname">
                <input type="text" placeholder="Last Name" required name="Lname">
                <input type="text" placeholder="Nationality" required name="Nationality">
            </div>

            <div class="row">
                <input type="text" placeholder="mobile phone" required name="phone">
                <input type="date" name="date" id="date" required name="date">
                <input type="email" required placeholder="example@gmail.com" name="email">
            </div>
            <div class="row">
                <input type="password" required placeholder="Password" name="password">
                <input type="password" required placeholder="R-Password">
            </div>
            <div class="row">                
                <div class="gender">
                    <label>Gender </label>
                    <div>
                        <input type="radio" name="gender" id="Male" value="M" checked required>
                        <label for="Male" >Male</label>
                    </div>
                    <div>
                        <input type="radio" name="gender" id="Female" value="F" required>
                        <label for="Female" >Female</label>
                    </div>
                </div>
                <!-- <button onclick="pageRedirect()">Submit <i class="fa fa-arrow-right"></i></button> -->
                    <input type="submit" value="Sign Up" class="button">
            </div>
        </form>
    </div>

    <footer>
        <img src="../first page/images/pngfind.com-duckling-png-5872453(Y).png" alt="">
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script> <!-- bootstrap -->
    <script src="../../js/all.min.js"></script>
    <!-- <script>
        function pageRedirect() {
            window.location.href = "../../Log_in/login.php";
        }  
    </script> -->
</body>
</html>