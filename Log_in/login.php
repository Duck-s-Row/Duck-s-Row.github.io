<?php
session_start();
include("../connection/connection.php");
include("../Functions/Functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // something was posted
   $username    = $_POST['username'];
   $password = $_POST['password'];
   
   if(!empty($username)&&!empty($password)&& !is_numeric($username)&&!is_numeric($password))
   {
        //read from database
        $user_id = random_num(20);
        $query = "select * from users where username = '$username' and password = '$password' limit 1";
        $result =mysqli_query($con,$query);
        if($result)
        {
            if($result && mysqli_num_rows($result)>0)
            {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password']=== $password)
                {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header('Location:../index.php');
                    die;
                }
            }
        }
        echo '<script>alert("Wrong username or password\nPlease Re-Enter them")</script>';
    }
   else
   {
        echo '<script>alert("Wrong username or password\nPlease Re-Enter them")</script>';
   }
}
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Duck's Row</title>
    <link rel="stylesheet" href="login.css">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <link rel="website icon" type="png" href="../home/imgs/Logo.png">
</head>
<body>
    <header>
        
        <div class="head">
            <h1>LOGIN</h1>
            <span>You don't have an account? <a href="../Sign_UP/first page/Sign_UP.php">Sign UP</a></span>
        </div>
    </header>
    <form method="POST" class="login">
        <div class="email">
            <input type="text" placeholder="username" name="username">
        </div>
        <div>
            <input type="password" placeholder="Password"name="password">
        </div>
        <div>
            <input type="submit" value="Login"><br /><br />
            <a href="../forget/page 1/forget.php" class="forget">Forget password?</a>
        </div><br /><br />
        <div class="icons">
            <a href="#"><img src="images/Rectangle 27jhftyf.png" width="40" height="40"/></a>
            <a href="#"><img src="images/Rectangle 26hjgyugyu.png" width="40" height="40"/></a>
        </div>
    </form>
    <footer class="logo">
        <img src="images/pngfind.com-duckling-png-5872453(Y).png" width="90" height="55"/>
    </footer>
</body>
</html>