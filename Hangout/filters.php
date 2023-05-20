<?php
require("../connection/connection.php");
require("../Functions/Functions.php");

$location = isset($_POST['location']) ? $_POST['location'] : "";
$sort = isset($_POST['sort']) ? $_POST['sort'] : "";
$budget = isset($_POST['budget']) ? $_POST['budget'] : "";
$categories = isset($_POST['categories']) ? json_decode($_POST['categories'], true) : [];
$places = filterLocationSort($con, $location, $sort, $categories,$budget);
echo json_encode($places);