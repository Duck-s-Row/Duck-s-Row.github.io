<?php
$error = array();

require "mail.php";
// require "forgot.php";

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "ducks_row";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname))
{
    die("failed to connect to database");
}
    
    // function send_email($email){
		
	// 	global $con;

	// 	// $expire = time() + (60 * 1);
	// 	$code = rand(100000,999999);
	// 	$email = addslashes($email);
    //     $headers = "From: omareidd22@gmail.com" . "\r\n" .

	// 	$query = "insert into codes (email,code) value ('$email','$code')";
	// 	mysqli_query($con,$query);

	// 	//send email here

	// 	// send_mail($email,'Password reset',"Your code is " . $code);
    //     mail($email,"password reset","Your code is " . $code, $headers);
	// }


    function save_password($password){
		
		global $con;

		$password = password_hash($password, PASSWORD_DEFAULT);
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "update users set password = '$password' where email = '$email' limit 1";
		mysqli_query($con,$query);

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

    // function is_code_correct($code){
	// 	global $con;

	// 	$code = addslashes($code);
	// 	$expire = time();
	// 	$email = addslashes($_SESSION['forgot']['email']);

	// 	$query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
	// 	$result = mysqli_query($con,$query);
	// 	if($result){
	// 		if(mysqli_num_rows($result) > 0)
	// 		{
	// 			$row = mysqli_fetch_assoc($result);
	// 			if($row['expire'] > $expire){

	// 				return "the code is correct";
	// 			}else{
	// 				return "the code is expired";
	// 			}
	// 		}else{
	// 			return "the code is incorrect";
	// 		}
	// 	}

	// 	return "the code is incorrect";
	// }
?>