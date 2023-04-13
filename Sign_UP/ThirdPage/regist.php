<?php
session_start();
include("../../connection/connection.php");
include("../../Functions/Functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // something was posted
   $username    = $_POST['username'];
   $password    = $_POST['password'];
   $hasedpassword = password_hash($password,PASSWORD_DEFAULT);
   $Fname       = $_POST['Fname'];
   $Lname       = $_POST['Lname'];
   $phone       = $_POST['phone'];
   $email       = $_POST['email'];
   $gender      = $_POST['gender'];
   
   if(!empty($username)&&!empty($password)&&!empty($phone)&&!empty($email)&&!empty($gender) && !is_numeric($username)&&!is_numeric($password)&&!is_numeric($email)&&!is_numeric($gender))
   {
        //save to database
        $user_id = random_num(20);
        $query = "insert into users(user_id,username,password,phone,email,gender,Fname,Lname) values(?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($con,$query);
        mysqli_stmt_bind_param($stmt,"isssssss",$user_id,$username,$hasedpassword,$phone,$email,$gender,$Fname,$Lname);
        mysqli_stmt_execute($stmt);
        
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
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="registiration.CSS">
    <link rel="website icon" type="png" href="../../home/imgs/Logo.png">
    <title>Registration</title>
</head>
<body>
    <div class="head">
        <h1>SIGN UP</h1>
    </div>
    <div class="content">
        <form  method="post">
            <div class="reg">
                <div class="left">
                    <div>
                        <label for="Username">username</label>
                        <input type="text" placeholder="username" required name="username" id="username">
                    </div>

                    <div>
                        <label for="email">Email</label>
                        <input type="email" placeholder="email@test.com" required name="email" id="email">
                    </div>

                    <div>
                        <label for="Password">Password</label>
                        <input type="password" placeholder="password" required name="password" id="password">
                        <i class="fa fa-eye" id="show-Password"></i> 
                        <p id="message">Password is <span id="strength"></span></p>
                    </div>


                    <div>
                        <label for="Password">Re-Password</label>
                        <input type="Password" placeholder="Re-Password" required name="re-password" id="re-password">
                        <i class="fa fa-eye" id="show-re-password"></i>
                        <p id="passtwo">Password is <span id="alert"></span></p>
                    </div>
                </div>


                <div class="right">
                    <div>
                        <label for="Fname">First Name</label>
                        <input type="text" placeholder="First Name" required name="Fname">
                    </div>

                    <div>
                        <label for="lastname">Last Name</label>
                        <input type="text" placeholder="Last name" required name="Lname">
                    </div>

                    <div>
                        <label for="phone">Phone</label>
                        <input type="phone" placeholder="phone number" required name="phone" id="phone">
                    </div>

                    <div class="gender">
                        <label for="gender">Gender</label>

                        <label for="Male">Male</label>
                        <input type="radio" required name="gender" value="M" id="Male">

                        <label for="Female">Female</label>
                        <input type="radio" required name="gender" value="F" id="Female">
                    </div>
                </div>
            </div>

            <div class="submit">
                <input type="submit" value="submit">
            </div>
        </form>
    </div>
    <footer>
        <img src="../../home/imgs/gold-ducks.png" alt="Logo">
    </footer>

    <script src="vaild.js"></script>
    <script>
        // Change the Password into text
        const showPassword = document.querySelector("#show-Password");
        const password = document.querySelector("#password");

        showPassword.addEventListener("click", function () {

            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            this.classList.toggle("bi-eye");
        });

        const ShowRePassword = document.querySelector("#show-re-password");
        const rePassword = document.querySelector("#re-password");

        ShowRePassword.addEventListener("click", function () {

            const type = rePassword.getAttribute("type") === "password" ? "text" : "password";
            rePassword.setAttribute("type", type);

            this.classList.toggle("bi-eye");
        });
    </script>
</body>
</html>