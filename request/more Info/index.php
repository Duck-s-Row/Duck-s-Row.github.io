<?php
require("../../connection/connection.php");
require('../../Functions/Functions.php');
session_start();
$request_id = $_SESSION['request_id'];
$user_id = $_SESSION['user_id'];
if (isset($_SESSION['user_id']) && isset($request_id)) {
    $user_data = Get_user_data($con);
    if ($user_data['privilege'] != 1 && $user_data['privilege'] != 2)
        header('Location:../../index.php');
} else {
    //redirect to login page
    header("Location: ../../Log_in/login.php");
    die;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="../../home/imgs/Logo.png">
    <link rel="stylesheet" href="indexstyle.css">
    <title>Request Adjustment</title>
</head>

<body>
    <header>
        <div class="logo"><a href="#home"><img src="../../home/imgs/ducks.png" alt=""></a></div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <?php if ($user_data['privilege'] == 1) :  ?>
                        <li><a href="dashboard/dashboard.php"><b>Dashboard</b></a></li>
                    <?php endif; ?>
                <?php endif; ?>
                <li><a href="#home"><b>Home</b></a></li>
                <li><a href="../Hangout/hangout.php"><b>Hangout</b></a></li> <!-- we could remove this ancher tag link because of using the button  -->
                <!-- <li><a href="Sign_UP/first page/Sign_up.php">My Plans</a></li> -->
                <li><a href="#about_us"><b>About</b></a></li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li><a href="../Profile/profile.php" class="profile"><b>Profile</b></a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <section class="request_details">
        <?php
        $selectPlaceIdQuery = "SELECT place_id From request_details WHERE request_id = $request_id";
        $resultPlace_id = mysqli_query($con,$selectPlaceIdQuery);
        $rowPlace_id = mysqli_fetch_assoc($resultPlace_id);
        $place_id = $rowPlace_id['place_id'];
        //picture query
        $pics_query = "SELECT * FROM request_place_pics WHERE place_id = $place_id ORDER BY RAND() ";
        $result_pics = mysqli_query($con, $pics_query);
        ?>
        <div class="photo">
            <div class="slider-container">
                <div id="slide-number" class="slide-number"></div>
                <?php
                if ($result_pics->num_rows > 0) {
                    while ($row_pics = $result_pics->fetch_assoc()) :
                        // $imageURL = '../places_imgs/'.$row_pics['photo_name']; 
                ?>
                        <img src="../../Hangout/places_imgs/<?php echo $row_pics['photo_name'] ?>" alt="">
                <?php endwhile;
                }  ?>
            </div>

            <div class="slider-controls">
                <span id="prev" class="prev"><i class="fa-solid fa-circle-arrow-left"></i></span>
                <span id="indicators" class="indicators"></span>
                <span id="next" class="next"><i class="fa-solid fa-circle-arrow-right"></i></span>
            </div>
        </div>
        <script src="slider.js"></script>
        <?php
        $selectReqQuery = "SELECT * FROM requests, request_details WHERE requests.user_id = $user_id AND requests.request_id = $request_id AND request_details.request_id = $request_id";
        $req_details = mysqli_query($con, $selectReqQuery);
        $eachDetail = mysqli_fetch_assoc($req_details);
        $place_id = $eachDetail['place_id'];

        ?>
        <form action="adjust request.php" method="post">
            <?php
            $selectComQuery = "SELECT * FROM request_comment WHERE place_id = $place_id";
            $AllCom = mysqli_query($con, $selectComQuery);
            if (mysqli_num_rows($AllCom) > 0) :
            ?>
                <div class="com-table">
                    <table>
                        <tr>
                            <th>Comment</th>
                            <th>Comment Date</th>
                        </tr>
                        <?php while ($eachCom = mysqli_fetch_assoc($AllCom)) : ?>
                            <tr>
                                <td><?php echo $eachCom['comment'] ?></td>
                                <td><?php echo $eachCom['com_date'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            <?php endif; ?>
            <div>
                <input type="hidden" name="place_id" value="<?php echo $eachDetail['place_id'] ?>" <?php if ($eachDetail['req_status'] == "Accepted") echo "readonly"; ?>>
                <label for="p_name">Place Name</label>
                <input type="text" name="p_name" id="p_name" value="<?php echo $eachDetail['p_name'] ?>" <?php if ($eachDetail['req_status'] == "Accepted") echo "readonly"; ?>>
            </div>
            <div>
                <label for="category">Category</label>
                <select name="category" id="category" <?php if ($eachDetail['req_status'] == "Accepted") echo "disabled"; ?>>
                    <option value="Cafe" <?php if ($eachDetail['category'] == "Cafe") echo "selected"; ?>>Cafe</option>
                    <option value="Restaurants" <?php if ($eachDetail['category'] == "Restaurants") echo "selected"; ?>>Restaurants</option>
                    <option value="Park" <?php if ($eachDetail['category'] == "Park") echo "selected"; ?>>Park</option>
                    <option value="Museums" <?php if ($eachDetail['category'] == "Museums") echo "selected"; ?>>Museums</option>
                    <option value="Mall" <?php if ($eachDetail['category'] == "Mall") echo "selected"; ?>>Mall</option>
                    <option value="Cinema" <?php if ($eachDetail['category'] == "Cinema") echo "selected"; ?>>Cinema</option>
                    <option value="EscapeRoom" <?php if ($eachDetail['category'] == "Escape Rooms") echo "selected"; ?>>Escape Rooms</option>
                </select>
            </div>
            <div>
                <label for="">Budget</label>
                <input type="number" name="min" id="" value="<?php echo $eachDetail['min_price'] ?>" <?php if ($eachDetail['req_status'] == "Accepted") echo "readonly"; ?>>-
                <input type="number" name="max" id="" value="<?php echo $eachDetail['max_price'] ?>" <?php if ($eachDetail['req_status'] == "Accepted") echo "readonly"; ?>>
                <p>Average</p>
            </div>
            <div>
                <label for="details">Details</label>
                <input type="text" name="details" id="details" value="<?php echo $eachDetail['details'] ?>" <?php if ($eachDetail['req_status'] == "Accepted") echo "readonly"; ?>>
            </div>
            <div>
                <label for="p_branch">Place Branch</label>
                <select id="p_branch" name="p_branch" <?php if ($eachDetail['req_status'] == "Accepted") echo "disabled"; ?>>
                    <optgroup label="GIZA">
                        <option value="haram" <?php if ($eachDetail['p_branch'] == "haram") echo "selected"; ?>>haram</option>
                        <option value="fisal" <?php if ($eachDetail['p_branch'] == "fisal") echo "selected"; ?>>fisal</option>
                        <option value="el doki" <?php if ($eachDetail['p_branch'] == "el doki") echo "selected"; ?>>el doki</option>
                        <option value="zamalek" <?php if ($eachDetail['p_branch'] == "zamalek") echo "selected"; ?>>zamalek</option>
                        <option value="6th october" <?php if ($eachDetail['p_branch'] == "6th october") echo "selected"; ?>>6th october</option>
                        <option value="el shiekh zayed" <?php if ($eachDetail['p_branch'] == "el shiekh zayed") echo "selected"; ?>>el shiekh zayed</option>
                        <option value="el mohandseen" <?php if ($eachDetail['p_branch'] == "el Mohandseen") echo "selected"; ?>>el Mohandseen</option>
                        <option value="el manial" <?php if ($eachDetail['p_branch'] == "el Manial") echo "selected"; ?>>el Manial</option>
                    </optgroup>
                </select>
            </div>
            <div>
                <label for="location">i Frame src Location</label>
                <input type="url" name="location" id="location" value="<?php echo $eachDetail['location'] ?>" <?php if ($eachDetail['req_status'] == "Accepted") echo "readonly"; ?>>
            </div>
            <div>
                <input type="submit" value="Update" <?php if ($eachDetail['req_status'] == "Accepted") echo "disabled"; ?>>
            </div>
        </form>
    </section>
</body>

</html>