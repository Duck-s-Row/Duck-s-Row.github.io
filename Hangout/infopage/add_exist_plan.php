<?php
require("../../connection/connection.php");
session_start();
$place_id = $_SESSION['place_id'];
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $plan_id = $_POST['pland_id'];

    $check_query = "SELECT * FROM exist_plan WHERE plan_id = $plan_id AND place_id = $place_id";
    $check_result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($check_result)>0) {
        echo "The Place already exists in that plan";
    } else {
        $insert_query = "INSERT INTO exist_plan(plan_id,place_id) VALUES($plan_id,$place_id) ";
        mysqli_query($con, $insert_query);
        echo "Place Added To The Plan Successfully";
    }
}
