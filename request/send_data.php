<?php 
session_start();
require("../connection/connection.php");
require("../Functions/Functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $p_name = $_POST['p_name'];
    $p_branch = $_POST['p_branch'];
    $details = $_POST['details'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $min = $_POST['min'];
    $max = $_POST['max'];
    $request_id = random_num(10);
    $place_id = random_num(10);
    $user_id = $_SESSION["user_id"];

    $average = ($min + $max) / 2;

    $request = "INSERT INTO request(request_id,place_id,user_id) VALUES($place_id, $request_id, $user_id)";
    mysqli_query($con, $request); 
    
    $request_details = "INSERT INTO request_details(place_id, request_id, p_name, p_branch, details, average_budget, category, location, min_price, max_price) VALUES($place_id, $request_id, '$p_name', '$p_branch', '$details', $average, '$category', '$location', $min, $max)";
    mysqli_query($con, $request_details); 

}