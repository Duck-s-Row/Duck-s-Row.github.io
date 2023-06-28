<?php 

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "ducks_row";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname))
{
    die("failed to connect to database");
}

//test