<?php
require("../../connection/connection.php");
require('../../Functions/Functions.php');
session_start();
$request_id = $_SESSION['request_id'];
if (isset($_SESSION['user_id']) && isset($request_id) ) {
    $user_data = Get_user_data($con);
    if ($user_data['privilege'] != 1)
        header('Location:../../index.php');
} else {
    //redirect to login page
    header("Location: ../../Log_in/login.php");
    die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>more</title>
</head>
<body>
    
</body>
</html>