<?php
    require("../connection/connection.php");

    $id = $_GET["id"];

    $sql = "DELETE FROM users WHERE user_id = $id";

    mysqli_query($con, $sql);

    header("Location: dashboard.php");
?>