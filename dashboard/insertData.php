<?php
session_start();
require("../connection/connection.php");
require('../Functions/Functions.php');
$select_places = "select * from places";
$result = mysqli_query($con, $select_places);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['Form_identifier'] == "insert_new_place") {
        $p_name = $_POST['p_name'];
        $p_branch = $_POST['p_branch'];
        $small_details = $_POST['small_details'];
        $more_details = $_POST['more_details'];
        $location = $_POST['location'];
        $category = $_POST['category'];
        $min = $_POST['min'];
        $max = $_POST['max'];
        $place_id = random_num(10);
        $average = ($min + $max) / 2;
        $uper_location = $_POST['uper_location'];
        $insert_place = "INSERT INTO places(p_name,p_branch,small_details,location,category,min_price,max_price,place_id,average_budget,more_details,uper_location) VALUES('$p_name','$p_branch','$small_details','$location','$category',$min,$max,$place_id,$average,'$more_details','$uper_location')";
        mysqli_query($con, $insert_place);
        header("Location:index.php");
    } else if ($_POST['Form_identifier'] == "insert_photo") {
        $place_id = $_POST['place_id'];
        $image_name = $_FILES['photo_name']['name'];
        $image_size = $_FILES['photo_name']['size'];
        $tmp_name = $_FILES['photo_name']['tmp_name'];

        //image validation 
        $valid_image_ext = ['jpg', 'png', 'jpeg'];
        $image_ext = explode('.', $image_name);
        $image_ext = strtolower(end($image_ext));
        if (!in_array($image_ext, $valid_image_ext)) {
            echo '
                    <script>alert("Invalid Image Extension");</script>';
            header('Location:index.php');
        } elseif ($image_size > 1200000) {
            echo '
                    <script>alert("Imgae Size Is Too Large");</script>';
            header('Location:index.php');
        } else {
            $photo_id = random_num(10);
            $new_image_name = random_num(10);
            $new_image_name .= "." . $image_ext;
            $insert_new_place_pic = "INSERT INTO place_pics(photo_id,place_id,photo_name) VALUES($photo_id,$place_id,'$new_image_name')";
            mysqli_query($con, $insert_new_place_pic);
            move_uploaded_file($tmp_name, '../Hangout/places_imgs/' . $new_image_name);
            header('Location:index.php');
        }
    } else if ($_POST['Form_identifier'] == "insert_logo") {
        $p_name = $_POST['p_name'];
        $logo_name = $_FILES['logo_name']['name'];
        $logo_size = $_FILES['logo_name']['size'];
        $tmp_name = $_FILES['logo_name']['tmp_name'];

        //image validation 
        $valid_logo_ext = ['jpg', 'png', 'jpeg'];
        $logo_ext = explode('.', $logo_name);
        $logo_ext = strtolower(end($logo_ext));
        if (!in_array($logo_ext, $valid_logo_ext)) {
            echo '
                    <script>alert("Invalid logo Extension");</script>';
            header('Location:index.php');
        } elseif ($logo_size > 1200000) {
            echo '
                    <script>alert("Logo Size Is Too Large");</script>';
            header('Location:index.php');
        } else {
            // $photo_id = random_num(10);
            $new_logo_name = random_num(10);
            $new_logo_name .= "." . $logo_ext;
            $update_logo = "UPDATE places SET logo = '$new_logo_name' WHERE p_name = '$p_name'";
            mysqli_query($con, $update_logo);
            move_uploaded_file($tmp_name, '../Hangout/logos/' . $new_logo_name);
            header('Location:index.php');
        }
    } else if ($_POST['Form_identifier'] == "insert_offer") {
        $offer_name = $_FILES['offer']['name'];
        $offer_size = $_FILES['offer']['size'];
        $tmp_name = $_FILES['offer']['tmp_name'];

        //image validation 
        $valid_offer_ext = ['jpg', 'png', 'jpeg'];
        $offer_ext = explode('.', $offer_name);
        $offer_ext = strtolower(end($offer_ext));
        if (!in_array($offer_ext, $valid_offer_ext)) {
            echo '
                    <script>alert("Invalid logo Extension");</script>';
            header('Location:index.php');
        } elseif ($offer_size > 1200000) {
            echo '
                    <script>alert("Logo Size Is Too Large");</script>';
            header('Location:index.php');
        } else {
            $offer_id = random_num(10);
            $new_offer_name = random_num(10);
            $new_offer_name .= "." . $offer_ext;
            $insert_offer = "INSERT INTO offers VALUES($offer_id,'$new_offer_name')";
            mysqli_query($con, $insert_offer);
            move_uploaded_file($tmp_name, '../Hangout/offers/' . $new_offer_name);
            header('Location:index.php');
        }
    } else if ($_POST['Form_identifier'] == "Insert_menu") {
        $menu_image_name = $_FILES['menu_image']['name'];
        $menu_image_size = $_FILES['menu_image']['size'];
        $tmp_name = $_FILES['menu_image']['tmp_name'];
        $placeName = $_POST['place_name_menu'];
        //image validation 
        $valid_menu_image_ext = ['jpg', 'png', 'jpeg'];
        $menu_image_ext = explode('.', $menu_image_name);
        $menu_image_ext = strtolower(end($menu_image_ext));
        if (!in_array($menu_image_ext, $valid_menu_image_ext)) {
            echo '
                    <script>alert("Invalid logo Extension");</script>';
            header('Location:index.php');
        } elseif ($menu_image_size > 1200000) {
            echo '
                    <script>alert("Logo Size Is Too Large");</script>';
            header('Location:index.php');
        } else {
            $new_menu_image_name = date('Y');
            $new_menu_image_name .= '_' . date('M');
            $new_menu_image_name .= '_' . "$placeName";
            $new_menu_image_name .= "." . $menu_image_ext;
            $insert_menu_image = "UPDATE places SET menu_image = '$new_menu_image_name' WHERE p_name = '$placeName' ";
            mysqli_query($con, $insert_menu_image);
            move_uploaded_file($tmp_name, '../Hangout/menus/' . "$new_menu_image_name");
            header('Location:index.php');
        }
    }
}
