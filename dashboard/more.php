<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $req_id = $_POST['req_id'];
        $_SESSION['request_id'] = $req_id;
        header("Location:more/index.php");
}
