<?php
require("../connection/connection.php");
require("../Functions/Functions.php");
if (isset($_REQUEST['location'])) {
    $location = $_REQUEST['location'];
    if ($location === "") {
        $places = getAllplaces($con);
    } else {
        $places = getplacesByLocation($con,$location);
    }
    echo json_encode($places);
}