<?php
    require("../connection/connection.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $privilege = $_POST["privilege"];

        $sql = "UPDATE users SET privilege='$privilege' WHERE user_id='$id'";

        mysqli_query($con, $sql);

        header("Location: dashboard.php");
    }
?>