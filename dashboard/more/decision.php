<?php 
require("../../connection/connection.php");
session_start();
$req_id = $_SESSION['request_id'];
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if($_POST['decision'] =="Accept"){
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
        $insertIntoPlaces = "INSERT INTO places(place_id,p_name,p_branch,category,location,min_price,max_price,average_budget,more_details) values($placeId,'$placeName','$placeBranch','$category','$locatoin',$min,$max,$average,'$details')";
        mysqli_query($con,$insertIntoPlaces);
        $updateRequestStatus = "UPDATE requests SET req_status = 'Accepted' WHERE request_id = $req_id";
        mysqli_query($con,$updateRequestStatus);
        header("Location:moreInfo.php");
    }else if($_POST['decision'] =="Reject"){
        $placeId = $_POST['place_id'];
        $comment = $_POST['comment'];
        if(!empty($comment)){
            $com_date = date('Y-m-d');
            $addComQuery = "INSERT INTO request_comment(place_id,comment,com_date) VALUES($placeId,'$comment','$com_date')";
            mysqli_query($con,$addComQuery);
        }
        $updateStatusQuery = "UPDATE requests SET req_status = 'Rejected' WHERE request_id = $req_id";
        mysqli_query($con,$updateStatusQuery);
        header("Location:moreInfo.php");
    }
}