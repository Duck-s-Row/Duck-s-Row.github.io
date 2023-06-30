<?php 
require("../../connection/connection.php");
session_start();
$req_id = $_SESSION['request_id'];
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $placeId = $_POST['place_id'];
    $placeName = $_POST['p_name'];
    $placeBranch = $_POST['p_branch'];
    $category = $_POST['category'];
    $locatoin = $_POST['location'];
    $min = $_POST['min'];
    $max =$_POST['max'];
    $average = ($min+$max)/2;
    // $logo = $_POST['logo'];
    // $menu = $_POST['menu'];
    $details = $_POST['details'];
    $update_req = "UPDATE requests SET req_status = 'pending' WHERE request_id = $req_id";
    mysqli_query($con,$update_req);
    $update_req_details = "UPDATE request_details SET p_name = '$placeName', p_branch = '$placeBranch', details = '$details', average_budget = $average, category = '$category', location= '$locatoin', min_price = $min, max_price= $max WHERE request_id = $req_id";
    mysqli_query($con,$update_req_details);
    header("Location:index.php");
}