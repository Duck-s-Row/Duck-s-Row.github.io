<?php
session_start();
include("../connection/connection.php");
include("../Functions/Functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // getting posted from user
   $username    = $_POST['username'];
   $password = $_POST['password'];
        //read from database
        $query = "select username,password from users where username = ? limit 1";
        $stmt = mysqli_prepare($con,$query);
        mysqli_stmt_bind_param($stmt,"s",$username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if($stmt)
        {
            if($stmt && mysqli_stmt_num_rows($stmt)>0)
            {
                mysqli_stmt_bind_result($stmt,$rowusername,$rowpassword);
                $user_data = mysqli_stmt_fetch($stmt);
                if(password_verify($password,$rowpassword))
                {
                    //getting user_id from database in a quick way till I get the right one
                    $query2="select * from users where username = '$username' limit 1";
                    $result= mysqli_query($con,$query2);
                    $user_data= mysqli_fetch_assoc($result);
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header('Location:../index.php');
                    die;
                }
            }
        }
        echo '<script>alert("Wrong username or password\nPlease Re-Enter them")</script>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duck's Row</title>
    <link rel="stylesheet" href="log.css">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <link rel="website icon" type="png" href="../home/imgs/Logo.png">
</head>
<body>
    <header>
        <div class="head">
            <h1>LOGIN</h1>
            <span>You don't have an account? <a href="../Sign_UP/ThirdPage/regist.php">Signup</a></span>
        </div>
    </header>
    <form method="POST" class="login">
            <input type="text" placeholder="username" name="username">

            <div class="pass">
                <input type="password" placeholder="Password"name="password" id="password">
                <!-- <i class="fa fa-eye" id="show-Password"></i> -->
            </div>
            <div>
                <input type="submit" value="Login">
            </div>
            <!-- <a href="../forget/page 1/forget.php" class="forget">Forget password?</a>

        <div class="icons">
            <a href="#"><img src="images/Rectangle 27jhftyf.png" width="40" height="40"/></a>
            <a href="#"><img src="images/Rectangle 26hjgyugyu.png" width="40" height="40"/></a>
        </div> -->
    </form>
    <footer class="logo">
        <img src="images/pngfind.com-duckling-png-5872453(Y).png" width="90" height="55"/>
    </footer>
    <script>
        // Change the Password into text
        const showPassword = document.querySelector("#show-Password");
        const password = document.querySelector("#password");

        showPassword.addEventListener("click", function () {

            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            this.classList.toggle("bi-eye");
        });
    </script>

</body>

</html>