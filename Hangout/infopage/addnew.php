<?php
require("../../Functions/Functions.php");
require("../../connection/connection.php");
session_start();
$place_id = $_SESSION['place_id'];
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $plan_id = random_num(5);
    $creation_date = date('Y-m-d H:i:s');

    //check if the plan name is empty 
    if (empty($_POST['plan_name'])) {
        $plan_name = "plan";
    } else {
        $plan_name = $_POST['plan_name'];
    }

    //check if the plan date is empty 
    if (empty($_POST['plan_date'])) {
        $plan_date = date('Y-m-d');
    } else {
        $plan_date = $_POST['plan_date'];
    }

    $query2 = "INSERT INTO user_plans(plan_id,plan_name,plan_date,creation_date,user_id) VALUES(?,?,?,?,?)";
    $stmt2 = mysqli_prepare($con, $query2);
    mysqli_stmt_bind_param($stmt2, 'issss', $plan_id, $plan_name, $plan_date, $creation_date, $user_id);
    mysqli_stmt_execute($stmt2);

    $query1 = "INSERT INTO exist_plan(plan_id,place_id) VALUES(?,?)";
    $stmt1 = mysqli_prepare($con, $query1);
    mysqli_stmt_bind_param($stmt1, 'ii', $plan_id, $place_id);
    mysqli_stmt_execute($stmt1);
    header("Location:index.php");
    // }
}
