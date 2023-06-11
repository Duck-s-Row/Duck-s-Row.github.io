<?php
session_start();
require('../connection/connection.php');
require('../Functions/Functions.php');
$user_data = check_login($con);

//
$select_two = "SELECT * FROM places ORDER BY RAND() LIMIT 2";
$result = mysqli_query($con ,$select_two);

//
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if($_POST['Form_identifier']=="more"){
        $place_id = $_POST['place_id'];
        $_SESSION['place_id'] = $place_id;
        header('Location:../Hangout/infopage/info.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plans.css">
   <link rel="website icon" type="png" href="../home/imgs/Logo.png">
    <title>My Planes</title>
</head>

<body>
    <!-- The Start of Navbar section -->
    <header>
        <div class="logo"><a href="../index.php"><img src="../home/imgs/ducks.png" alt=""></a></div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../Hangout/hangout.php">Hnagout</a></li>
                <!-- <li><a href="Sign_UP/first page/Sign_up.php">My Planes</a></li> -->
                <li><a href="#about_us">About</a></li>
                <li><a href="../Profile/profile.php" class="profile">Profile</a></li>
            </ul>
        </nav>
    </header>
    <!-- The End of Navbar section -->

    <section class="plans">
        <div class="left">
            <div class="ad">
                <img src="../Hangout/offers/4911930.png" alt="" id="image">
            </div>
            <div class="content">
                <h1>Users Plans</h1>
                <div class="plan_card" id="open">
                    <h3>Plan Name</h3>
                    <h3>Average: 200</h3>
                </div>
                <div class="plan_card" id="open">
                    <h3>Plan Name</h3>
                    <h3>Average: 200</h3>
                </div>
                <div class="plan_card" id="open">
                    <h3>Plan Name</h3>
                    <h3>Average: 200</h3>
                </div>
                <div class="plan_card" id="open">
                    <h3>Plan Name</h3>
                    <h3>Average: 200</h3>
                </div>
                <div class="plan_card" id="open">
                    <h3>Plan Name</h3>
                    <h3>Average: 200</h3>
                </div>
                <div class="plan_card" id="open">
                    <h3>Plan Name</h3>
                    <h3>Average: 200</h3>
                </div>
                <div class="plan_card" id="open">
                    <h3>Plan Name</h3>
                    <h3>Average: 200</h3>
                </div>
                <div class="plan_card" id="open">
                    <h3>Plan Name</h3>
                    <h3>Average: 200</h3>
                </div>
                <div class="plan_card" id="open">
                    <h3>Plan Name</h3>
                    <h3>Average: 200</h3>
                </div>
                <div class="plan_card" id="open">
                    <h3>Plan Name</h3>
                    <h3>Average: 200</h3>
                </div>
                <div class="plan_card" id="open">
                    <h3>Plan Name</h3>
                    <h3>Average: 200</h3>
                </div>
                <div class="plan_card" id="open">
                    <h3>Plan Name</h3>
                    <h3>Average: 200</h3>
                </div>
            </div>
        </div>

        <div class="right">
            <h2>suggestion</h2>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="card">
                <img src="../Hangout/logos/<?php echo $row['logo']; ?>" alt="logo">
                <div class="text1">
                    <h3><?php echo $row['p_name']; ?></h3>
                    <h4> <?php echo $row['p_branch']; ?></h4>
                    <p><?php echo $row['more_details'] ?></p>
                </div>
                <div class="more">
                    <form method="POST">
                        <input type="hidden" name="Form_identifier" value="add_to_plan">
                        <input type="hidden" name="place_id" value="<?php echo $row['place_id']; ?>">
                        <input type="submit" name="delete" id="delete" value="Add to Plan">
                    </form>
                    <form method="POST">
                        <input type="hidden" name="Form_identifier" value="more">
                        <input type="hidden" name="place_id" value="<?php echo $row['place_id']; ?>">
                        <input type="submit" name="more" id="more" value="more">
                    </form>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>

    <section class="popup" id="popup">
        <button id="close"><i class="fa fa-x"></i></button>

        <div class="popup_content">
            <h1>Plan Name</h1>
            <div class="card">
                <img src="../Hangout/logos/22050178.png" alt="logo">
                <div class="text1">
                    <h3>Dunkin</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo, cupiditate!</p>
                </div>
                <div class="more">
                    <form method="POST">
                        <input type="hidden" name="place_id_delete" value="<?php //echo $row2['place_id']; ?>">
                        <input type="hidden" name="Form_identifier" value="Delete">
                        <input type="submit" name="delete" id="delete" value="Delete">
                    </form>
                    <form method="POST">
                        <input type="hidden" name="place_id" value="<?php //echo $row2['place_id']; ?>">
                        <input type="hidden" name="Form_identifier" value="More">
                        <input type="submit" name="more" id="more" value="More">
                    </form>
                </div>
            </div>
            <div class="card">
                <img src="../Hangout/logos/22050178.png" alt="logo">
                <div class="text1">
                    <h3>Dunkin</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo, cupiditate!</p>
                </div>
                <div class="more">
                    <form method="POST">
                        <input type="hidden" name="place_id_delete" value="<?php // echo $row2['place_id']; ?>">
                        <input type="hidden" name="Form_identifier" value="Delete">
                        <input type="submit" name="delete" id="delete" value="Delete">
                    </form>
                    <form method="POST">
                        <input type="hidden" name="place_id" value="<?php // echo $row2['place_id']; ?>">
                        <input type="hidden" name="Form_identifier" value="More">
                        <input type="submit" name="more" id="more" value="More">
                    </form>
                </div>
            </div>
            <div class="card">
                <img src="../Hangout/logos/22050178.png" alt="logo">
                <div class="text1">
                    <h3>Dunkin</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo, cupiditate!</p>
                </div>
                <div class="more">
                    <form method="POST">
                        <input type="hidden" name="place_id_delete" value="<?php // echo $row2['place_id']; ?>">
                        <input type="hidden" name="Form_identifier" value="Delete">
                        <input type="submit" name="delete" id="delete" value="Delete">
                    </form>
                    <form method="POST">
                        <input type="hidden" name="place_id" value="<?php // echo $row2['place_id']; ?>">
                        <input type="hidden" name="Form_identifier" value="More">
                        <input type="submit" name="more" id="more" value="More">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="about_us" id="about_us">
        <div class="content">
            <h3>About <span>Duck’s Row</span></h3>
            <p>
                Duck's Row is trying to organize your time so you can have fun in various locations while staying inside the limits of your preferred spending limit. <br>We need you to enjoy yourself and go to your favourite destinations.
            </p>
            <div class="icons">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
            <div class="contact">
                <h3><span>contact</span> us</h3>
                <p>Telephone : <a href="tel:+201556892517">01556892517</a><br>
                    Email : <a href="mailto:ducksrow100@gmail.com">ducksrow100@gmail.com</a><br>
                </p>
            </div>
        </div>
    </section>

    <script src="app.js"></script>
    <script>
        let images = [];
        <?php
        $select_offer = "SELECT * FROM offers";
        $result_offer = mysqli_query($con, $select_offer);
        while ($row_offers = mysqli_fetch_array($result_offer)) {
            echo "images.push('" . $row_offers['offer_image'] . "');";
        }
        ?>

        let image = document.getElementById('image');
        setInterval(function() {
            let random = Math.floor(Math.random() * images.length);
            image.src = '../Hangout/offers/' + images[random];
        }, 2000);
    </script>
</body>

</html>