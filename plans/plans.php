<?php
    session_start();
    include("../connection/connection.php");
    include("../Functions/Functions.php");
    // echo"<pre>";
    // print_r($_SESSION);
    // echo"</pre>";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['Form_identifier'] == "More"){
            $place_id = $_POST['place_id'];
            $_SESSION['place_id'] = $place_id;
            header('Location:../Hangout/infopage/info.php');
        }
        if ($_POST['Form_identifier'] == "Delete"){
            $delete = $_POST['place_id_delete'];
            $plans = "DELETE FROM user_plans WHERE place_id =".$delete." AND user_id = ".$_SESSION['user_id'].";";
            mysqli_query($con,$plans);
            header("Location:plans.php");
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
    <link rel="stylesheet" href="planeee.css">
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
                <li><a href="#contact_us">About</a></li>
                <li><a href="../Profile/profile.php" class="profile">Profile</a></li>
            </ul>
        </nav>
    </header>
    <!-- The End of Navbar section -->

    <section class="plans">
        <div class="left">
            <h1>Places from your choice</h1>
            <?php
                    $total = 0;
                    $plans = "SELECT * FROM user_plans WHERE user_id =". $_SESSION['user_id'].";";
                    $result = mysqli_query($con,$plans);
                    while ($row = mysqli_fetch_array($result)) :
                        $place = "SELECT * FROM places WHERE place_id =". $row['place_id'].";";
                        $result2 = mysqli_query($con,$place);
                        $row2 = mysqli_fetch_array($result2);
                        $total += $row2['average_budget'];
            ?>
            <div class="card">
                <img src="../Hangout/logos/ echo $row2['logo'] ?>" alt="Logo Picture">
                <div class="text1">
                    <h1><?=$row2['p_name']?></h1>
                    <div class="dis">
                        <p>
                            <?=$row2['category']?>
                        </p>
                    </div>
                    <h6>Average: </h6>
                    <?=$row2['average_budget']?>
                </div>
                <div class="location-text">
                    <i class="fa-solid fa-location-dot"></i>
                    <p><?=$row2['p_branch']?></p>
                </div>
                <div class="more">
                    <form method="POST">
                        <input type="hidden" name="place_id_delete" value="<?php echo $row2['place_id']; ?>">
                        <input type="hidden" name="Form_identifier" value="Delete">
                        <input type="submit" name="delete" id="delete" value="Delete">
                    </form>
                    <form method="POST">
                        <input type="hidden" name="place_id" value="<?php echo $row2['place_id']; ?>">
                        <input type="hidden" name="Form_identifier" value="More">
                        <input type="submit" name="more" id="more" value="More">
                    </form>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="right">
            <h1>The average budget you will have is</h1>
            <p id="total">AVG = <?=$total?> EGP</p>
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
</body>
</html>