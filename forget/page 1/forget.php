<?php

session_start();
$error = array();

// include("../../connection/connection.php");
require "../func.php";
// require "mail.php";

$mode = "enter_email";
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "ducks_row";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname))
{
    die("failed to connect to database");
}
	// if(!$con = mysqli_connect("localhost","root","","test")){

	// 	die("could not connect");
	// }




    
	//something is posted
	if(count($_POST) > 0){

		switch ($mode) {
			case 'enter_email':
				// code...
				$email = $_POST['email'];
				//validate email
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error[] = "Please enter a valid email";
				}elseif(!valid_email($email)){
					$error[] = "That email was not found";
				}else{

					$_SESSION['forgot']['email'] = $email;
					send_email($email);
                    echo"done";
					header("Location: ../page 4/forget4.php");
					die;
				}
				break;
                default:
				// code...
				break;
		}
    }
    
    function send_email($email){
		
		global $con;

		// $expire = time() + (60 * 1);
		$code = rand(100000,999999);
		$email = addslashes($email);
        $headers = "From: omareidd22@gmail.com" . "\r\n" .

		$query = "insert into codes (email,code) value ('$email','$code')";
		mysqli_query($con,$query);

		//send email here

		// send_mail($email,'Password reset',"Your code is " . $code);
        mail($email,"password reset","Your code is " . $code);

	}
    
    
?>



<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Duck's Row</title>
    <link rel="stylesheet" href="forget.css">
    <link rel="website icon" type="png" href="../home/imgs/Logo.png">
</head>
<body>

    <?php 

        switch ($mode) {
            case 'enter_email': // 
                // code...
                ?>
            <header>
                <div class="head">
                    <h1>FORGET PASSWORD</h1>
                    <span>New Password</span>
                </div>
            </header>


            <section class="forget-password">
                <div class="content">
                    <p>E-mail</p>

                <div class="email">
                    <form action="forget.php?mode=enter_email" method = "post"> 
                        <input type="email" placeholder="E-mail" name="email" />

                        <!-- new button submit -->
                        <input type="submit" name="send" value="send">
                    </form>
                </div>

                    <!-- <button onclick="pageRedirect()">Send</button> -->
                </div>
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
            window.location.href = "../page 4/forget4.php";
        }  
    </script> -->


</body>
</html>