<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "KAreem@2012";
$dbname = "ducks_row";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect!");
}

?>