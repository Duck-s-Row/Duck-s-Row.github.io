<?php
require("../../connection/connection.php");
require('../../Functions/Functions.php');
session_start();
$request_id = $_SESSION['request_id'];
if (isset($_SESSION['user_id']) && isset($request_id)) {
    $user_data = Get_user_data($con);
    if ($user_data['privilege'] != 1)
        header('Location:../../index.php');
} else {
    //redirect to login page
    header("Location: ../../Log_in/login.php");
    die;
}
$selectRquestDetails = "SELECT * FROM users, requests, request_details WHERE users.user_id = requests.user_id AND requests.request_id = $request_id  And request_details.request_id = $request_id limit 1";
$reqDetails = mysqli_query($con, $selectRquestDetails);
$eachDetail = mysqli_fetch_assoc($reqDetails);
$place_id = $eachDetail['place_id'];
$selectImgs = "SELECT photo_name,photo_id FROM request_place_pics WHERE place_id = $place_id";
$allImgs = mysqli_query($con, $selectImgs);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="../../home/imgs/Logo.png">
    <title>More Request's Info</title>
</head>

<body>
    <p>Request Sender: <?php echo $eachDetail['username'] ?> </p>
    <p>Request Status: <?php echo $eachDetail['req_status'] ?></p>
    <form action="decision.php" method="post">
        <input type="hidden" name="place_id" value="<?php echo $eachDetail['place_id'] ?>">
        <label for="p_name">place Name</label>
        <input type="text" name="p_name" id="p_name" value="<?php echo $eachDetail['p_name'] ?>" readonly><br>
        <label for="cateogry">Cateogry</label>
        <input type="text" name="category" id="cateogry" value="<?php echo $eachDetail['category'] ?>" readonly><br>
        <label for="">Budget</label>
        <input type="number" name="min" id="" value="<?php echo $eachDetail['min_price'] ?>" readonly>- <input type="number" name="max" id="" value="<?php echo $eachDetail['max_price'] ?>" readonly><br>
        <label for="">Average</label>
        <p><?php echo $eachDetail['average_budget'] ?></p><br>
        <label for="details">Details</label>
        <input type="text" name="details" id="details" value="<?php echo $eachDetail['details'] ?>" readonly><br>
        <label for="p_branch">place Branch</label>
        <input type="text" name="p_branch" id="p_branch" value="<?php echo $eachDetail['p_branch'] ?>" readonly><br>
        <img src="../../Hangout/logos/<?php echo $eachDetail['logo'] ?>" alt="logo"><br>
        <input type="hidden" name="logo" value="<?php echo $eachDetail['logo'] ?>">
        <img src="../../Hangout/menus/<?php echo $eachDetail['menu_image'] ?>" alt="menu"><br>
        <input type="hidden" name="menu" value="<?php echo $eachDetail['menu_image'] ?>">
        <?php $count = 1;
        while ($eachImg = mysqli_fetch_assoc($allImgs)) : ?>
            <input type="hidden" name="image<?php echo $count ?>" value="<?php echo $eachImg['photo_name']; ?>">
            <input type="hidden" name="imageId<?php echo $count ?>" value="<?php echo $eachImg['photo_id']; ?>">
            <img src="../../Hangout/places_imgs/<?php echo $eachImg['photo_name']; ?>" alt="<?php echo $count ?>">
            <?php $count++; ?>
        <?php endwhile; ?>
        <label for="location">Location</label>
        <input type="hidden" name="location" value="<?php echo $eachDetail['location'] ?>">
        <iframe width="50%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $eachDetail['location']; ?>&output=embed" allowfullscreen id="location"></iframe>
        <label for="comment">If you have Comment Leave It Here:</label>
        <input type="text" name="comment" id="comment">
        <input type="submit" name="decision" value="Reject" <?php if($eachDetail['req_status']== "Accepted") echo "disabled" ?>>
        <input type="submit" name="decision" value="Accept" <?php if($eachDetail['req_status']== "Accepted") echo "disabled" ?>>
    </form>
</body>

</html>