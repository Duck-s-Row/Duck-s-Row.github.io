<?php 
session_start();
require('../../connection/connection.php');
require('../../Functions/Functions.php');
check_privilege_hangout($con);
$select_places = "select * from places";
$result = mysqli_query($con,$select_places);
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
            header('Location:profile.php');
        } elseif ($image_size > 1200000) {
            echo '
            <script>alert("Imgae Size Is Too Large");</script>';
            header('Location:profile.php');
        } else {
            $photo_id= random_num(10);
            $new_image_name = random_num(10);
            $new_image_name .= "." . $image_ext;
            $insert_new_place_pic = "INSERT INTO place_pics(photo_id,place_id,photo_name) VALUES($photo_id,$place_id,'$new_image_name')";
            mysqli_query($con, $insert_new_place_pic);
            move_uploaded_file($tmp_name, '../places_imgs/' . $new_image_name);
            header('Location:profilee.php');
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
        <label for="p_branch">place branch:</label>
        <input type="text" name="p_branch" id="p_branch"><br>
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
    </form>
</body>
</html>