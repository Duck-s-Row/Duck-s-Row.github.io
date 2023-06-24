<?php
    require("../connection/connection.php");

    $id = $_GET["id"];

    $sql1 = "DELETE FROM user_plans WHERE place_id = $id";
    $sql2 = "DELETE FROM place_pics WHERE place_id = $id";
    $sql3 = "DELETE FROM places WHERE place_id = $id";

    mysqli_query($con, $sql1);
    mysqli_query($con, $sql2);
    mysqli_query($con, $sql3);

    header("Location: dashboard.php");
?>