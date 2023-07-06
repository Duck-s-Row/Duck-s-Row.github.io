<?php
require("../../connection/connection.php");
session_start();
$req_id = $_SESSION['request_id'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['decision'] == "Accept") {
        $placeId = $_POST['place_id'];
        $placeName = $_POST['p_name'];
        $placeBranch = $_POST['p_branch'];
        $category = $_POST['category'];
        $locatoin = $_POST['location'];
        $min = $_POST['min'];
        $max = $_POST['max'];
        $average = ($min + $max) / 2;
        $logo = $_POST['logo'];
        $menu = $_POST['menu'];
        $details = $_POST['details'];
        $uper_location = $_POST['uper_location'];
        $insertIntoPlaces = "INSERT INTO places(place_id,p_name,p_branch,category,location,min_price,max_price,average_budget,more_details,logo,menu_image,uper_location) values($placeId,'$placeName','$placeBranch','$category','$locatoin',$min,$max,$average,'$details','$logo','$menu','$uper_location')";
        mysqli_query($con, $insertIntoPlaces);
        //insert images
        $checkNumImgsQuery = "SELECT photo_name FROM request_place_pics WHERE place_id = $placeId";
        $ALLnumImgs = mysqli_query($con, $checkNumImgsQuery);
        $i = 1;
        while (mysqli_fetch_assoc($ALLnumImgs)) {
            $imgName = $_POST["image$i"];
            $photoId = $_POST["imageId$i"];
            $insertimgQuery = "INSERT INTO place_pics(photo_id,place_id,photo_name) VALUES($photoId,$placeId,'$imgName')";
            mysqli_query($con, $insertimgQuery);
            $i++;
        }

        $updateRequestStatus = "UPDATE requests SET req_status = 'Accepted' WHERE request_id = $req_id";
        mysqli_query($con, $updateRequestStatus);
        header("Location:index.php");
    } else if ($_POST['decision'] == "Reject") {
        $placeId = $_POST['place_id'];
        $comment = $_POST['comment'];
        if (!empty($comment)) {
            $com_date = date('Y-m-d');
            $addComQuery = "INSERT INTO request_comment(place_id,comment,com_date) VALUES($placeId,'$comment','$com_date')";
            mysqli_query($con, $addComQuery);
        }
        $updateStatusQuery = "UPDATE requests SET req_status = 'Rejected' WHERE request_id = $req_id";
        mysqli_query($con, $updateStatusQuery);
        header("Location:index.php");
    }
}
