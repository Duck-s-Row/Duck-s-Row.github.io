<?php
require("../connection/connection.php");
require("../Functions/Functions.php");

$location = isset($_POST['location']) ? $_POST['location'] : "";
$sort = isset($_POST['sort']) ? $_POST['sort'] : "";
$places = filterLocationSort($con,$location,$sort);
echo json_encode($places);