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
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <link rel="website icon" type="png" href="../../home/imgs/Logo.png">
    <title>More Request's Info</title>
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="m3.css">
</head>

<body>
    <div class="back">
        <a onclick="window.history.back()"><i class="fa-solid fa-circle-left"></i></a>
        <img src="../../Hangout/logos/<?php echo $eachDetail['logo'] ?>" alt="logo" height="70" width="70"><br>
        <input type="hidden" name="logo" value="<?php echo $eachDetail['logo'] ?>">
    </div>
    <div id="menu_popup" class="popup_menu">
        <button id="close_menu"><i class="fa fa-x"></i></button>
        <div class="popup_content" id="popup_content">
            <img src="../menus/<?php echo $row['menu_image'] ?>" alt="">
        </div>
    </div>
    <form action="decision.php" method="post">
        <div class="content">
            <div class="left">
                <div class="main_slide">
                    <div class="slider-container">
                        <div id="slide-number" class="slide-number"></div>
                        <?php $count = 1;
                        while ($eachImg = mysqli_fetch_assoc($allImgs)) : ?>
                            <input type="hidden" name="image<?php echo $count ?>" value="<?php echo $eachImg['photo_name']; ?>">
                            <input type="hidden" name="imageId<?php echo $count ?>" value="<?php echo $eachImg['photo_id']; ?>">
                            <img src="../../Hangout/places_imgs/<?php echo $eachImg['photo_name']; ?>" alt="<?php echo $count ?>">
                            <?php $count++; ?>
                        <?php endwhile; ?>
                    </div>
                    <div class="slider-controls">
                        <span id="prev" class="prev"><i class="fa-solid fa-angles-left"></i></span>
                        <span id="indicators" class="indicators"></span>
                        <span id="next" class="next"><i class="fa-solid fa-angles-right"></i></span>
                    </div>
                </div>
                <script src="slider.js"></script>
                <div class="menu">
                    <!-- MENU<img src="../../Hangout/menus/<?php echo $eachDetail['menu_image'] ?>" alt="menu" height="100" width="100"><br> -->
                    <!-- popup -->
                    MENU
                    <p class="open" id="open_menu">Show menu</p>
                    <input type="hidden" name="menu" value="<?php echo $eachDetail['menu_image'] ?>">

                    <label for="location">Location</label>
                    <input type="hidden" name="location" value="<?php echo $eachDetail['location'] ?>">
                    <iframe width="100%" height="180" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $eachDetail['location']; ?>&output=embed" allowfullscreen id="location"></iframe>
                </div>
            </div>

            <div class="right">
                <p>Request Sender : <span><?php echo $eachDetail['username'] ?></span> </p>
                <p>Request Status : <span><?php echo $eachDetail['req_status'] ?></span></p><br>
                <input type="hidden" name="place_id" value="<?php echo $eachDetail['place_id'] ?>">
                <label for="p_name">place Name</label>
                <input type="text" name="p_name" id="p_name" value="<?php echo $eachDetail['p_name'] ?>" readonly><br>
                <label for="cateogry">Cateogry</label>
                <input type="text" name="category" id="cateogry" value="<?php echo $eachDetail['category'] ?>" readonly><br>

                <label for="">Budget</label>
                <div class="budget">
                    <input type="number" name="min" id="" value="<?php echo $eachDetail['min_price'] ?>" readonly>- <input type="number" name="max" id="" value="<?php echo $eachDetail['max_price'] ?>" readonly><br>
                </div>

                <label>Average</label>
                <p><?php echo $eachDetail['average_budget'] ?></p><br>
                <label for="details">Details</label>
                <input type="text" name="details" id="details" value="<?php echo $eachDetail['details'] ?>" readonly><br>
                <label for="p_branch">place Branch</label>
                <input type="text" name="p_branch" id="p_branch" value="<?php echo $eachDetail['p_branch'] ?>" readonly><br>

                <div class="comment">
                    <label for="comment">If you have Comment Leave It Here:</label><br>
                    <input type="text" name="comment" id="comment">
                </div>
            </div>
        </div>
        <div class="btns">
            <input type="submit" name="decision" value="Reject" <?php if ($eachDetail['req_status'] == "Accepted") echo "disabled" ?>>
            <input type="submit" name="decision" value="Accept" <?php if ($eachDetail['req_status'] == "Accepted") echo "disabled" ?>>
        </div>
    </form>
    <script>
                // Menu Popup page
                var popup_menu = document.getElementById("menu_popup");
        var close_menu = document.getElementById("close_menu");
        var open_menu = document.getElementById("open_menu");

        close_menu.addEventListener("click", ()=> {
            popup_menu.style.display = "none";
        });

        open_menu.addEventListener("click", ()=> {
            popup_menu.style.display = "flex";
            close_menu.style.display = "block";
        });
        
        const minInput = document.getElementById('min');
        const maxInput = document.getElementById('max');
        const avrSpan = document.getElementById('avr');

        const min = parseFloat(minInput.value);
        const max = parseFloat(maxInput.value);

        const average = (min + max) / 2;
        if(isNaN(average)){
            avrSpan.textContent = 0;
        } else {
            avrSpan.textContent = average.toFixed(2);
        }

        avrSpan.textContent = average.toFixed(2);
        
        minInput.addEventListener('input', calculateAverage);
        maxInput.addEventListener('input', calculateAverage);
        
        function calculateAverage() {
            const min = parseFloat(minInput.value);
            const max = parseFloat(maxInput.value);
            
            const average = (min + max) / 2;
            if(isNaN(average)){
                avrSpan.textContent = 0;
            } else {
                avrSpan.textContent = average.toFixed(2);
            }
            
            avrSpan.textContent = average.toFixed(2);
        }
    </script>
</body>

</html>