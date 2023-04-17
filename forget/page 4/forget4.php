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



	$mode = "enter_code";
	if(isset($_GET['mode'])){
		$mode = $_GET['mode'];
	}

    	//something is posted
	if(count($_POST) > 0){

		switch ($mode) {
            case 'enter_code':
				// code...
				$code = $_POST['code'];
				$result = is_code_correct($code);
                

				if($result == "the code is correct"){

                    $_SESSION['forgot']['code'] = $code;
                    header("Location: ../page 5/forget5.php");
                    die;
				}else{
					$error[] = $result;
				}
				break;

				
		}
    }

    function is_code_correct($code){
		global $con;

		$code = addslashes($code);
		// $expire = time();
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
		$result = mysqli_query($con,$query);
		if($result){

			// if(mysqli_num_rows($result) > 0)
			// {
				return "the code is correct";
                
		}

		return "the code is incorrect";
	}


?>



<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Duck's Row</title>
    <link rel="stylesheet" href="forget4.css">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
</head>
<body>



    <?php 

    switch ($mode) {

        case 'enter_code':
            // code...
            ?>
            <header>
                <div class="head">
                    <h1>Forget Password</h1>
                    <span>A code has been sent to your E-mail. Enter that code here</span>
                </div>
            </header>

            <!-- form -->
            <form method="post" action="forget4.php?mode=enter_code">
                <section class="forget-password-ways">
                    <h1 class="enter">Enter Code</h1>
                    <div class="code">   
                        <!--  new input ... handle css -->
                        <input type="text" name="code" placeholder="Enter Code" /><br>
                        <!-- <input type="text" maxlength="1">
                        <input type="text" maxlength="1">
                        <input type="text" maxlength="1" class="space">
                        <input type="text" maxlength="1" >
                        <input type="text" maxlength="1">
                        <input type="text" maxlength="1"> -->
                    </div>

                        <!-- new button submit -->
                    <input type="submit" name="send" value="continue">

                    <!-- <a href="#" class="again">send code again?</a> -->

                    <!-- <div>
                        
                        <button class="cont" onclick="pageRedirect()">continue</button>
                    </div> -->
                </section>
            </form>


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

    
    <script>
        const inputs = document.querySelectorAll(".code input");
        inputs.forEach((input, index) => {
            input.dataset.index = index;
            input.addEventListener("paste", handleOtppaste);
            input.addEventListener("keyup", handleOtp);
        });
        function handleOtppaste(e){
            const data = e.clipboardData.getData("text");
            const value = data.split("");
            if(value.length === inputs.length){
                inputs.forEach((input, index) => (input.value = value[index]));
                submit();
            }
        }
        function handleOtp(e){
            const input = e.target;
            let value = input.value;
            input.value = "";
            input.value = value ? value[0] : "";
            let fieldIndex = input.dataset.index;
            if(value.length > 0 && fieldIndex < inputs.length - 1){
                input.nextElementSibling.focus();
            }
            if(e.key === "Backspace" && fieldIndex > 0){
                input.previousElementSibling.focus();
            }
            if(fieldIndex == inputs.length ){
                submit();
            }
        }
        function submit(){
            console.log("submitting....!");
            let otp = "";
            inputs.forEach((input) => {
                otp += input.value;
                input.disabled = true ;
                input.classList.add("disabled");
            });
            console.log(otp);
        }

        // function pageRedirect() {
        //     window.location.href = "../page 5/forget5.php";
        // }
    </script>
</body>
</html>