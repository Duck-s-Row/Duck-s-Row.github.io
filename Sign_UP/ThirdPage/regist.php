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
    //save to database

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
    <link rel="stylesheet" href="registiration.CSS">
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
    </div>
    <div class="content">
        <form method="post">
            <div class="reg">
                <div class="left">
                    <div>
                        <label for="Username">username</label>
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
                    <input type="password" id="password" placeholder="Enter your password">
                    <span class="password-toggle" onclick="togglePasswordVisibility()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/></svg>
                    </span>
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
                <input type="submit" value="submit">
            </div>
        </form>
    </div>
    <footer>
        <img src="../../home/imgs/gold-ducks.png" alt="Logo">
    </footer>

    <script src="regist.js"></script>
    <script>
        // Change the Password into text
        function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var passwordToggle = document.querySelector(".password-toggle svg path");

        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          passwordToggle.setAttribute("d", "M12 3a9 9 0 0 1 2.97 17.3l1.43 1.44a1 1 0 0 1-1.42 1.42l-1.44-1.43A9 9 0 1 1 12 3zm0 2a7 7 0 0 0-.65 13.96l.65.04V5zm0 4a3 3 0 1 1 0 6 3 3 0 0 1 0-6zM9 9a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm6 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z");
        } else {
          passwordInput.type = "password";
          passwordToggle.setAttribute("d", "M12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z");
        }
      }

        const ShowRePassword = document.getElementById("#show-re-password");
        const rePassword = document.getElementById("#re-password");

        ShowRePassword.addEventListener("click", function() {

            const type = rePassword.getAttribute("type") === "password" ? "text" : "password";
            rePassword.setAttribute("type", type);

            this.classList.toggle("bi-eye");
        });
    </script>
</body>

</html>