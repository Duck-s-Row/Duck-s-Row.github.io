<?php 
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$to = "ducksrow100@gmail.com";
$subject  = $name."has a question for you";
$headers = "MIME-Version: 1.0"."\r\n";
$headers .="content-type:text/html;charset=UTF-8"."\r\n";
$headers.= "From: ".$email."\r\n";
$send = mail($to,$subject,$message,$headers);

if(!$send)
    echo "Error: Message not send. Please try again";
else
    echo "Message Sent Successfuly";

