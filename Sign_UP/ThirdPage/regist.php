<?php
session_start();
include("../../connection/connection.php");
include("../../Functions/Functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // something was posted
    $username    = $_POST['username'];
    $password    = $_POST['password'];
    $hasedpassword = password_hash($password, PASSWORD_DEFAULT);
    $Fname       = $_POST['Fname'];
    $Lname       = $_POST['Lname'];
    $phone       = $_POST['phone'];
    $email       = $_POST['email'];
    $gender      = $_POST['gender'];


    // Check if the username already exists in the database
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      // Username already exists, alert the user
      echo "<script>alert('The username you entered already exists. Please choose a different username.');</script>";
    }else{
      // Username doesn't exist, store the user signup information in the database
      $user_id = random_num(20);
      $query = "insert into users(user_id,username,password,phone,email,gender,Fname,Lname) values(?,?,?,?,?,?,?,?)";
      $stmt = mysqli_prepare($con, $query);
      mysqli_stmt_bind_param($stmt, "isssssss", $user_id, $username, $hasedpassword, $phone, $email, $gender, $Fname, $Lname);
      mysqli_stmt_execute($stmt);
      header('Location:../../Log_in/login.php');
      die();
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
    <link rel="stylesheet" href="reg.CSS">
    <link rel="website icon" type="png" href="../../home/imgs/Logo.png">
    <title>Registration</title>
    <style>
      .password-input {
        position: relative;
      }

      .password-toggle {
        position: absolute;
        top: 50%;
        right: 5px;
        transform: translateY(-50%);
        cursor: pointer;
      }
    </style>
</head>

<body>
    <div class="head">
        <h1>SIGN UP</h1>
        <span>You have already an account? <a href="../../Log_in/login.php">Login</a></span>
    </div>
    <div class="content">
        <form method="post">
            <div class="reg">
                <div class="left">
                    <div>
                        <label for="Username">Username</label>
                        <input type="text" placeholder="username" required name="username" id="username">
                        
                        <?php
                        // Check connection

                        ?>
                    </div>


                    <div>
                        <label for="email">Email</label>
                        <input type="email" placeholder="email@test.com" required name="email" id="email">
                    </div>

                    <div>
                        <label for="Password">Password</label>
                        <input type="password" placeholder="password" required name="password" id="password">
                        <i class="fa fa-eye" id="toggle-password" onclick="togglePassword()"></i>
                        <p id="message">Password is <span id="strength"></span></p>
                    </div>


                    <div>
                        <label for="Password">Re-Password</label>
                        <input type="Password" placeholder="Re-Password" required name="re-password" id="re-password">
                        <i class="fa fa-eye" id="toggle-re-password" onclick="toggleRePassword()"></i>
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
                        <input type="phone" placeholder="phone number" required name="phone" maxlength="13" id="phone">
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
                <input type="submit" value="submit" id="sub-btn">
            </div>
        </form>
    </div>
    <footer>
        <img src="../../home/imgs/gold-ducks.png" alt="Logo">
    </footer>
      
    <script src="registiration.js"></script>
</body>

</html>