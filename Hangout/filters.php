<?php
require("../connection/connection.php");
require("../Functions/Functions.php");

$location = isset($_POST['location']) ? $_POST['location'] : "";
$sort = isset($_POST['sort']) ? $_POST['sort'] : "";
$categories = isset($_POST['categories']) ? json_decode($_POST['categories'], true) : [];
$places = filterLocationSort($con, $location, $sort, $categories);
echo json_encode($places);