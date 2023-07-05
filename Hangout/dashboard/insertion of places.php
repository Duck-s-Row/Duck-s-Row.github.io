<?php
session_start();
require('../../connection/connection.php');
require('../../Functions/Functions.php');
check_privilege_hangout($con);
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
        $insert_place = "INSERT INTO places(p_name,p_branch,small_details,location,category,min_price,max_price,place_id,average_budget,more_details) VALUES('$p_name','$p_branch','$small_details','$location','$category',$min,$max,$place_id,$average,'$more_details')";
        mysqli_query($con, $insert_place);
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
            header('Location:insertion of places.php');
        } elseif ($image_size > 1200000) {
            echo '
            <script>alert("Imgae Size Is Too Large");</script>';
            header('Location:insertion of places.php');
        } else {
            $photo_id = random_num(10);
            $new_image_name = random_num(10);
            $new_image_name .= "." . $image_ext;
            $insert_new_place_pic = "INSERT INTO place_pics(photo_id,place_id,photo_name) VALUES($photo_id,$place_id,'$new_image_name')";
            mysqli_query($con, $insert_new_place_pic);
            move_uploaded_file($tmp_name, '../places_imgs/' . $new_image_name);
            header('Location:insertion of places.php');
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
            header('Location:insertion of places.php');
        } elseif ($logo_size > 1200000) {
            echo '
            <script>alert("Logo Size Is Too Large");</script>';
            header('Location:insertion of places.php');
        } else {
            // $photo_id = random_num(10);
            $new_logo_name = random_num(10);
            $new_logo_name .= "." . $logo_ext;
            $update_logo = "UPDATE places SET logo = '$new_logo_name' WHERE p_name = '$p_name'";
            mysqli_query($con, $update_logo);
            move_uploaded_file($tmp_name, '../logos/' . $new_logo_name);
            header('Location:insertion of places.php');
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
            header('Location:insertion of places.php');
        } elseif ($offer_size > 1200000) {
            echo '
            <script>alert("Logo Size Is Too Large");</script>';
            header('Location:insertion of places.php');
        } else {
            $offer_id = random_num(10);
            $new_offer_name = random_num(10);
            $new_offer_name .= "." . $offer_ext;
            $insert_offer = "INSERT INTO offers VALUES($offer_id,'$new_offer_name')";
            mysqli_query($con, $insert_offer);
            move_uploaded_file($tmp_name, '../offers/' . $new_offer_name);
            header('Location:insertion of places.php');
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
            <script>alert("Invalid menu Extension");</script>';
            header('Location:insertion of places.php');
        } elseif ($menu_image_size > 1200000) {
            echo '
            <script>alert("Menu Size Is Too Large");</script>';
            header('Location:insertion of places.php');
        } else {            
            $new_menu_image_name = date('Y');
            $new_menu_image_name .= '_' . date('M');
            $new_menu_image_name .= '_' . "$placeName";
            $new_menu_image_name .= "." . $menu_image_ext;
            $insert_menu_image = "UPDATE places SET menu_image = '$new_menu_image_name' WHERE p_name = '$placeName' ";
            mysqli_query($con, $insert_menu_image);
            move_uploaded_file($tmp_name, '../menus/' . "$new_menu_image_name");
            header('Location:insertion of places.php');
        }
    }

    header('Location:insertion of places.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="insertions.css">
    <link rel="website icon" type="png" href="../home/imgs/Logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="../../home/imgs/Logo.png">
    <title>insertion</title>
</head>

<body>
    <header>
        <div class="logo"><a href="../../index.php"><img src="../../home/imgs/ducks.png" alt=""></a></div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../../plans/index.php">My Plans</a></li>
                <!-- <li><a href="Sign_UP/first page/Sign_up.php">My Planes</a></li> -->
                <!-- <li><a href="#contact_us">About</a></li> -->
                <li><a href="../../Profile/index.php" class="profile">Profile</a></li>
                <li><a href="../index.php" class="profile">Hangout</a></li>
            </ul>
        </nav>
    </header>


    <form method="post" align='center' class="place">
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
        <label for="small_details">Small details:</label>
        <input type="text" name="small_details" id="small_details"><br>
        <label for="more_details">More details:</label>
        <input type="text" name="more_details" id="more_details"><br>
        <label for="category">Category:</label>
        <select name="category" id="">
            <option value="Cafe">Cafe</option>
            <option value="Restaurants">Restaurants</option>
            <option value="Park">Park</option>
            <option value="Museums">Museums</option>
            <option value="Mall">Mall</option>
            <option value="Cinema">Cinema</option>
            <option value="EscapeRoom">Escape Rooms</option>
            <option value="Pool">Pools</option>
            <option value="KidsArea">Kids Area</option>
            <option value="BowlingHall">Bowling Halls</option>
        </select><br>
        <label for="location">Location:</label>
        <input type="url" name="location" id="location"><br>
        <label for="min">Min:</label>
        <input type="number" name="min" id="min">
        <label for="max">Max:</label>
        <input type="number" name="max" id="mx"><br>
        <input type="submit" value="save">
    </form><br><br>


    <form method="post" align=center enctype="multipart/form-data" class="photo">
        <input type="hidden" name="Form_identifier" value="insert_photo">
        <label for="p_name">choose a place:</label>
        <select id="p_name" name="place_id">
            <?php
            while ($row = mysqli_fetch_assoc($result)) : ?>
                <option value="<?php echo $row['place_id'] ?>"><?php echo $row['p_name'] . " " . $row['p_branch'] ?></option>
            <?php endwhile; ?>
        </select><br>
        <label for="photo_name">insert photo</label>
        <input type="file" name="photo_name" id="photo_name" accept=".jpg, .png, .jpeg"><br>
        <input type="submit" value="save">
    </form><br>



    <form method="post" enctype="multipart/form-data" align=center class="logo">
        <label for="p_name">choose a place:</label>
        <select id="p_name" name="p_name">
            <?php
            $select_places1 = "SELECT DISTINCT p_name FROM places";
            $result1 = mysqli_query($con, $select_places1);
            while ($row1 = mysqli_fetch_assoc($result1)) : ?>
                <option value="<?php echo $row1['p_name'] ?>"><?php echo $row1['p_name'] ?></option>
            <?php endwhile; ?>
        </select><br>
        <input type="hidden" name="Form_identifier" value="insert_logo">
        <label for="logo_name">insert logo</label>
        <input type="file" name="logo_name" id="logo_name" accept=".jpg, .png, .jpeg"><br>
        <input type="submit" value="save">
    </form>

    <form method="post" enctype="multipart/form-data" align=center class="offers">
        <input type="hidden" name="Form_identifier" value="insert_offer">
        <label for="offer">Insert offer picture</label>
        <input type="file" name="offer" id="offer" accept=".jpg, .png, .jpeg"><br>
        <input type="submit" value="save">
    </form>
    <form method="POST" align='center' enctype="multipart/form-data" class="menu">
        <input type="hidden" name="Form_identifier" value="Insert_menu">
        <label for="place_name_menu">choose place</label>
        <select name="place_name_menu" id="place_name_menu">
            <?php
            $selectALLPlacesN = "SELECT distinct p_name FROM places WHERE category = 'Restaurants' OR category = 'Cafe' OR category = 'Cinema'";
            $placesNames = mysqli_query($con, $selectALLPlacesN);
            while ($eachPlaceName = mysqli_fetch_array($placesNames)) :
            ?>
                <option value="<?php echo $eachPlaceName['p_name'] ?>"><?php echo $eachPlaceName['p_name'] ?></option>
            <?php endwhile; ?>
        </select><br>
        <label for="menu_image">Insert Menu Image</label>
        <input type="file" name="menu_image" id="menu_image" accept=".jpg, .png, .jpeg"><br>
        <input type="submit" value="Save">  
    </form>
</body>

</html>