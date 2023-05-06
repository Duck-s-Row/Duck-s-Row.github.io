<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "ducks_row";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname))
{
    die("failed to connect to database");
}

session_start();
$error = array();

$mode = "enter_email";
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}



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
        $headers = "From: ducksrow100@gmail.com" . "\r\n" ;

		$query = "insert into codes (email,code) value ('$email','$code')";
		mysqli_query($con,$query);

		//send email here

		send_mail($email,"Password reset","Your code is " . $code);

        // mail($email,"password reset","Your code is " . $code);

	}


    function valid_email($email){
		global $con;

		$email = addslashes($email);

		$query = "select * from users where email = '$email' limit 1";		
		$result = mysqli_query($con,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				return true;
 			}
		}

		return false;

	}

    // third code

    // function send_mail($recipient,$subject,$message)
    // {
    //     $mail = new PHPMailer(true);

    //     try {
    //         $mail->isSMTP();
    //         $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    //         $mail->Host       = 'smtp.gmail.com';
    //         $mail->SMTPAuth   = true;
    //         $mail->Username   = 'ducksrow100@gmail.com';
    //         $mail->Password   = 'rrxrerksucwnhglx';
    //         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //         $mail->Port       = 587;

    //         $mail->setFrom('ducksrow100@gmail.com', 'Your Name');
    //         $mail->addAddress($recipient);

    //         $mail->isHTML(true);
    //         $mail->Subject = $subject;
    //         $mail->Body = $message;

    //         $mail->send();
    //         return true;
    //     } catch (Exception $e) {
    //         return false;
    //     }
    // }


//second code
 

    // function send_mail($recipient,$subject,$message)
    // {

    // $mail = new PHPMailer(true);

    // $mail->IsSMTP();
    // $mail->Host ='smtp.gmail.com';
    // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    // $mail->Username   = 'ducksrow100@gmail.com';                     //SMTP username
    // $mail->Password   = 'rrxrerksucwnhglx';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    // $mail->Port       = 465; 
    // $mail->setFrom('ducksrow100@gmail.com');

    // $mail->addAddress($recipient); 
    // $mail->isHTML(true);

    // $mail->Subject = $subject;
    // $mail->Body = $message;
    
    // $mail->send();

    // echo 
    // "
    // <script>
    // alert('sent successfully');
    // document.location.href = 'index.php';
    // </script>
    // ";
    
    // }


 // first code

 
function send_mail($recipient,$subject,$message)
{

    $mail = new PHPMailer(true);

    $mail->IsSMTP();
    $mail->Host ='smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ducksrow100@gmail.com';
    $mail->Password = 'rrxrerksucwnhglx';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('ducksrow100@gmail.com');

    $mail->addAddress($recipient);
    
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();

    echo 
    "
    <script>
    alert('sent successfully);
    document.location.href = 'index.php';
    </script>
    ";
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
                        <input type="email" placeholder="E-mail" name="email" /><br>

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

</body>
</html>