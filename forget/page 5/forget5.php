<?php

session_start();
$error = array();

// include("../../connection/connection.php");
require "../func.php";


$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "ducks_row";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname))
{
    die("failed to connect to database");
}


$mode = "enter_password";
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}



    //something is posted
    if(count($_POST) > 0){

        switch ($mode) {
            case 'enter_password':
				// code...
				$password = $_POST['password'];
				$password2 = $_POST['password2'];

				if($password !== $password2){
					$error[] = "Passwords do not match";
				}elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
					header("Location: forget.php");
					die;
				}else{
					
					save_password($password);
					if(isset($_SESSION['forgot'])){
						unset($_SESSION['forgot']);
					}

					header("Location: ../../Log_in/login.php");
					die;
				}
				break;
        }
    }
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Duck's Row</title>
    <link rel="stylesheet" href="forget5.css">
    <link rel="website icon" type="png" href="../home/imgs/Logo.png">
</head>
<body>



    <?php 

    switch ($mode) {

        case 'enter_password':
            // code...
            ?>
                <header>
                    <div class="head">
                        <h1>FORGET PASSWORD</h1>
                        <span>Enter New Password</span>
                    </div>
                </header>


                <section class="forget-password">
                    <form method="post" action="forget5.php?mode=enter_password">
                        <div class="content">
                            <div class="newpass">
                                <input type="password" placeholder="New password" name="password"/><br>
                                <input type="password" placeholder="Confirm new password"  name="password2"/>
                                
                                <!-- new button submit -->
                                <input type="submit" value="confirm">
                            </div>
                            <!-- <button onclick="pageRedirect()">Confirm</button> -->
                        </div>
                    </form>
                </section>

                
                <footer class="logo">
                    <img src="../images/pngfind.com-duckling-png-5872453(Y).png" width="90" height="55"/>
                </footer>
            <?php
            break;
        
        default:
            // code...
            break;
    }

?>

    <!-- <script>
        function pageRedirect() {
            window.location.href = "../../Log_in/login.php";
        }
    </script> -->

</body>
</html>