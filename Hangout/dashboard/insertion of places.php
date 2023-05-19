<?php 
session_start();
require('../../connection/connection.php');
require('../../Functions/Functions.php');
check_privilege_hangout($con);
$select_places = "select * from places";
$result = mysqli_query($con,$select_places);
$select_places1 = "select * from places";
$result1 = mysqli_query($con,$select_places1);
if($_SERVER['REQUEST_METHOD']=="POST"){
    if ($_POST['Form_identifier'] == "insert_new_place"){
        $p_name = $_POST['p_name'];
        $p_branch = $_POST['p_branch'];
        $details = $_POST['details'];
        $location = $_POST['location'];
        $category = $_POST['category'];
        $min = $_POST['min'];
        $max = $_POST['max'];
        $place_id = random_num(10);
        $average = ($min+$max)/2; 
        $insert_place = "INSERT INTO places(p_name,p_branch,details,location,category,min_price,max_price,place_id,average_budget) VALUES('$p_name','$p_branch','$details','$location','$category',$min,$max,$place_id,$average)";
        mysqli_query($con,$insert_place);
    }else if ($_POST['Form_identifier'] == "insert_photo"){
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
            header('Location:insertion of places.php');
        } elseif ($image_size > 1200000) {
            echo '
            <script>alert("Imgae Size Is Too Large");</script>';
            header('Location:insertion of places.php');
        } else {
            $photo_id= random_num(10);
            $new_image_name = random_num(10);
            $new_image_name .= "." . $image_ext;
            $insert_new_place_pic = "INSERT INTO place_pics(photo_id,place_id,photo_name) VALUES($photo_id,$place_id,'$new_image_name')";
            mysqli_query($con, $insert_new_place_pic);
            move_uploaded_file($tmp_name, '../places_imgs/' . $new_image_name);
            header('Location:insertion of places.php');
        }
    }else if ($_POST['Form_identifier'] == "insert_logo"){
        $place_id = $_POST['place_id'];
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
            header('Location:insertion of places.php');
        } elseif ($logo_size > 1200000) {
            echo '
            <script>alert("Logo Size Is Too Large");</script>';
            header('Location:insertion of places.php');
        } else {
            $photo_id= random_num(10);
            $new_logo_name = random_num(10);
            $new_logo_name .= "." . $logo_ext;
            $update_logo = "UPDATE places SET logo = '$new_logo_name' WHERE place_id = $place_id";
            mysqli_query($con, $update_logo);
            move_uploaded_file($tmp_name, '../logos/' . $new_logo_name);
            header('Location:insertion of places.php');
        }
    }
    
    header('Location:insertion of places.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insertion</title>
</head>
<body>
    <form method="post" align='center'>
    <input type="hidden" name="Form_identifier" value="insert_new_place">
        <label for="p_name">place :</label>
        <input type="text" name="p_name" id="p_name"><br>
        <!-- <input type="text" name="p_branch" id="p_branch"><br> -->
        <label for="p_branch">place branch:</label>
        <select id="p_branch" name="p_branch">
                    <optgroup label="GIZA">
                        <option value="haram">haram</option>
                        <option value="fisal">fisal</option>
                        <option value="el doki">el doki</option>
                        <option value="zamalek">zamalek</option>
                        <option value="6th october">6th october</option>
                        <option value="el shiekh zayed">el shiekh zayed</option>
                        <option value="el mohandseen">el Mohandseen</option>
                        <option value="el manial">el Manial</option>
                    </optgroup>
        </select><br>
        <label for="details">details:</label>
        <input type="text" name="details" id="details"><br>
        <label for="category">Category:</label>
        <select name="category" id="">
            <option value="Cafe">Cafe</option>
            <option value="Restaurants">Restaurants</option>
            <option value="Park">Park</option>
            <option value="Museums">Museums</option>
        </select><br>
        <label for="location">Location:</label>
        <input type="url" name="location" id="location"><br>
        <label for="min">Min:</label>
        <input type="number" name="min" id="min">
        <label for="max">Max:</label>
        <input type="number" name="max" id="mx"><br>
        <input type="submit" value="save">
    </form><br><br>
    <form method="post" align=center enctype="multipart/form-data">
    <input type="hidden" name="Form_identifier" value="insert_photo">
    <label for="p_name">choose a place:</label>
    <select id="p_name" name="place_id">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <option value="<?php echo $row['place_id']?>"><?php echo $row['p_name'] ?></option>
            <?php endwhile; ?>
        </select><br>
        <label for="photo_name">insert photo</label>
        <input type="file" name="photo_name" id="photo_name" accept=".jpg, .png, .jpeg"><br>
        <input type="submit" value="save">
    </form><br>
    <form method="post" enctype="multipart/form-data" align=center>
        <select id="p_name" name="place_id">
            <?php while($row1 = mysqli_fetch_assoc($result1)): ?>
                <option value="<?php echo $row1['place_id']?>"><?php echo $row1['p_name'] ?></option>
            <?php endwhile; ?>
        </select><br>
        <input type="hidden" name="Form_identifier" value="insert_logo">
        <label for="logo_name">insert logo</label>
        <input type="file" name="logo_name" id="logo_name" accept=".jpg, .png, .jpeg"><br>
        <input type="submit" value="save">
        
    </form>
</body>
</html>