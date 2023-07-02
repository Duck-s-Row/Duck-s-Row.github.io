<?php
session_start();
require("../../connection/connection.php");
require("../../Functions/Functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $p_name = $_POST['p_name'];
    $p_branch = $_POST['p_branch'];
    $details = $_POST['details'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $min = $_POST['min'];
    $max = $_POST['max'];
    $request_id = random_num(10);
    $place_id = random_num(10);
    $user_id = $_SESSION["user_id"];
    $average = ($min + $max) / 2;



    $request = "INSERT INTO requests(request_id,user_id) VALUES( $request_id, $user_id)";
    mysqli_query($con, $request);

    $request_details = "INSERT INTO request_details(place_id, request_id, p_name, p_branch, details, average_budget, category, location, min_price, max_price) VALUES($place_id, $request_id, '$p_name', '$p_branch', '$details', $average, '$category', '$location', $min, $max)";
    mysqli_query($con, $request_details);


    // insert images 

    //insert logo
    $logo_name = $_FILES['logo']['name'];
    $logo_size = $_FILES['logo']['size'];
    $tmp_name = $_FILES['logo']['tmp_name'];

    //logo Validation
    $valid_logo_ext = ['jpg', 'png', 'jpeg'];
    $logo_ext = explode('.', $logo_name);
    $logo_ext = strtolower(end($logo_ext));
    if (!in_array($logo_ext, $valid_logo_ext)) {
        echo '<script>alert("Invalid logo Extension");</script>';
        header("Location:index.php");
    } elseif ($logo_size > 1200000) {
        echo '<script>alert("Logo Size Is Too Large");</script>';
        header("Location:index.php");
    } else {
        $new_logo_name = random_num(10);
        $new_logo_name .= "." . $logo_ext;
        $updateLogoQuery = "UPDATE request_details SET logo = '$new_logo_name' WHERE place_id = $place_id";
        mysqli_query($con, $updateLogoQuery);
        move_uploaded_file($tmp_name, '../../Hangout/logos/' . $new_logo_name);
    }
    
    //insert menu 
    $menu_name = $_FILES['menu']['name'];
    $menu_size = $_FILES['menu']['size'];
    $tmp_name = $_FILES['menu']['tmp_name'];
    //menu validation
    $valid_menu_ext = ['jpg', 'png', 'jpeg'];
    $menu_ext = explode('.', $menu_name);
    $menu_ext = strtolower(end($menu_ext));
    if (!in_array($menu_ext, $valid_menu_ext)) {
        echo '<script>alert("Invalid menu Extension");</script>';
        header("Location:index.php");
    }elseif($menu_size >1200000){
        echo '<script>alert("Menu Size Is Too Large");</script>';
    }else {
        $new_menu_name =random_num(10);
        $new_menu_name .= "." . $menu_ext;
        $updateMenuQuery = "UPDATE request_details SET menu_image = '$new_menu_name' WHERE place_id = $place_id";
        mysqli_query($con,$updateMenuQuery);
        move_uploaded_file($tmp_name, '../../Hangout/menus/' . $new_menu_name);
    }
    
    //insert place imgs
    $image_count = count($_FILES['image']['name']);
    for($i =0;$i<$image_count;$i++){
        $image_name = $_FILES['image']['name'][$i];
        $image_size = $_FILES['image']['size'][$i];
        $tmp_name = $_FILES['image']['tmp_name'][$i];
        //image validation
        $valid_image_ext = ['jpg','png','jpeg'];
        $image_ext = explode('.',$image_name);
        $image_ext = strtolower(end($image_ext));
        if(!in_array($image_ext,$valid_image_ext)){
            echo '<script>alert("Invalid image number '. $i+1 .' Extension");</script>';
            header("Location:index.php");
        }elseif($image_size >1200000){
            echo '<script>alert("Image Number'. $i+1 .'Size Is Too Large");</script>';
            header("Location:index.php");
        }else{
            $new_image_name = random_num(10);
            $photo_id = $new_image_name;
            $new_image_name .= "." . $image_ext;
            $insertImageQuery= "INSERT INTO request_place_pics VALUES($photo_id,$place_id,'$new_image_name')";
            mysqli_query($con,$insertImageQuery);
            move_uploaded_file($tmp_name, '../../Hangout/places_imgs/' . $new_image_name);
        }
    }
    header("location:index.php");
}
