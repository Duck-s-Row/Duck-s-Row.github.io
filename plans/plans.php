<?php
session_start();
require('../connection/connection.php');
require('../Functions/Functions.php');
$user_data = check_login($con);
$user_id = $_SESSION['user_id'];
//
$select_two = "SELECT * FROM places ORDER BY RAND() LIMIT 2";
$result = mysqli_query($con, $select_two);

//
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['Form_identifier'] == "more") {
        $place_id = $_POST['place_id'];
        $_SESSION['place_id'] = $place_id;
        header('Location:../Hangout/infopage/info.php');
    } else if ($_POST['Form_identifier'] == "Delete_place") {
        $place_id_delete = $_POST['place_id'];
        $plan_id_delete = $_POST['plan_id'];
        $deletePlaceQuery = "DELETE FROM exist_plan WHERE place_id = $place_id_delete AND plan_id = $plan_id_delete";
        mysqli_query($con, $deletePlaceQuery);
        header("Location:plans.php");
    } else if ($_POST['Form_identifier'] == "remove_plan") {
        $plan_id_remove = $_POST['plan_id'];
        $removePlanQuery = "DELETE FROM exist_plan WHERE  plan_id = $plan_id_remove ";
        mysqli_query($con, $removePlanQuery);
        $removePlanQuery = "DELETE FROM user_plans WHERE user_id = $user_id AND plan_id = $plan_id_remove ";
        mysqli_query($con, $removePlanQuery);
        header("Location:plans.php");
    } else if ($_POST['Form_identifier'] == "change_name_date") {
        $plan_id_name_date = $_POST['plan_id'];
        $plan_name = $_POST['plan_name'];
        $plan_date = $_POST['plan_date'];
        $changeNameDateQuery = "UPDATE user_plans SET plan_name = ?,plan_date = ? WHERE plan_id = ?";
        $stmt = mysqli_prepare($con, $changeNameDateQuery);
        mysqli_stmt_bind_param($stmt, "ssi", $plan_name, $plan_date, $plan_id_name_date);
        mysqli_stmt_execute($stmt);
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
    <link rel="stylesheet" href="p12.css">
    <link rel="website icon" type="png" href="../home/imgs/Logo.png">
    <title>My Plans</title>
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
                <?php if ($user_data['privilege'] == 1) :  ?>
                    <li><a href="../dashboard/dashboard.php">Dashboard</a></li>
                    <li><a href="request/index.php">Requests</a></li>
                <?php elseif ($user_data['privilege'] == 2) : ?>
                    <li><a href="request/index.php">Requests</a></li>
                <?php endif; ?>
                <li><a href="../Hangout/hangout.php">Hangout</a></li>
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
                <?php
                $selectPlansQuery = "SELECT * FROM user_plans WHERE user_id = $user_id";
                $allPlans = mysqli_query($con, $selectPlansQuery);
                ?>
                <?php if (mysqli_num_rows($allPlans) > 0) : ?>
                    <h1>Your Plans</h1>
                    <?php while ($eachPlan = mysqli_fetch_assoc($allPlans)) : ?>
                        <div class="r1">
                            <div class="plan_card" onclick="openPopup(<?php echo $eachPlan['plan_id']; ?>);">
                                <h3><?php echo $eachPlan['plan_name'] ?></h3>
                                <h3><?php echo $eachPlan['plan_date'] ?></h3>
                                <h3>Average : <?php echo $eachPlan['average'] ?></h3>
                            </div>
                            <div class="remove">
                                <form method="POST">
                                    <input type="hidden" name="Form_identifier" value="remove_plan">
                                    <input type="hidden" name="plan_id" value="<?php echo $eachPlan['plan_id'] ?>">
                                    <button><i class="fa-solid fa-trash"></i><input type="submit" value=""></button>
                                </form>
                            </div>
                        </div>
                        <section class="popup" id="popup_<?php echo $eachPlan['plan_id']; ?>">
                            <button id="close" onclick="closePopup(<?php echo $eachPlan['plan_id']; ?>);"><i class="fa fa-x"></i></button>

                            <div class="popup_content">
                                <form method="post">
                                    <input type="hidden" name="Form_identifier" value="change_name_date">
                                    <input type="hidden" name="plan_id" value="<?php echo $eachPlan['plan_id'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i><input type="text" name="plan_name" value=" <?php echo $eachPlan['plan_name'] ?>"><br>
                                    <input type="date" name="plan_date" value="<?php echo $eachPlan['plan_date'] ?>"><br>
                                    <input type="submit" value="Save">
                                </form>
                                <?php
                                $plan_id = $eachPlan['plan_id'];
                                $selectAllPlacesQuery = "SELECT * FROM exist_plan,places WHERE  exist_plan.plan_id = $plan_id AND exist_plan.place_id = places.place_id ORDER BY Rand()";
                                $allPlacesInEachPlan = mysqli_query($con, $selectAllPlacesQuery);
                                // if(mysqli_num_rows($allPlacesInEachPlan)>0){

                                while ($eachPlace = mysqli_fetch_assoc($allPlacesInEachPlan)) :
                                ?>
                                    <div class="card">
                                        <img src="../Hangout/logos/<?php echo $eachPlace['logo'] ?>" alt="logo">
                                        <div class="text1">
                                            <h3><?php echo $eachPlace['p_name'] ?></h3>
                                            <p><?php echo $eachPlace['more_details'] ?></p>
                                        </div>
                                        <div class="more">
                                            <form method="POST">
                                                <input type="hidden" name="Form_identifier" value="Delete_place">
                                                <input type="hidden" name="plan_id" value="<?php echo $plan_id ?>">
                                                <input type="hidden" name="place_id" value="<?php echo $eachPlace['place_id']; ?>">
                                                <input type="submit" name="delete" id="delete" value="Delete">
                                            </form>
                                            <form method="POST">
                                                <input type="hidden" name="Form_identifier" value="more">
                                                <input type="hidden" name="place_id" value="<?php echo $eachPlace['place_id']; ?>">
                                                <input type="submit" name="more" id="more" value="more">
                                            </form>
                                        </div>
                                    </div>
                                <?php endwhile;
                                // }else{
                                //     $delete_plan  = "DELETE FROM exist_plan,user_plans WHERE exist_plan.plan_id = $plan_id AND user_plans = $plan_id";
                                //     mysqli_query($con,$delete_plan);
                                // }
                                ?>
                            </div>
                        </section>
                    <?php endwhile; ?>
                <?php else : ?>
                    <h1>You don't Have Any Plans ?<br><a href="../Hangout/hangout.php">Add new one</a></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="right">
            <h2>suggestion</h2>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="card">
                    <img src="../Hangout/logos/<?php echo $row['logo']; ?>" alt="logo">
                    <div class="text1">
                        <h3><?php echo $row['p_name']; ?></h3>
                        <h4> <?php echo $row['p_branch']; ?></h4>
                        <p><?php echo $row['more_details'] ?></p>
                    </div>
                    <div class="more">
                        <!-- <form method="POST">
                            <input type="hidden" name="Form_identifier" value="add_to_plan">
                            <input type="hidden" name="place_id" value="<?php //echo $row['place_id']; 
                                                                        ?>">
                            <input type="submit" name="delete" id="delete" value="Add to Plan">
                        </form> -->
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

    <section class="contact_us" id="contact_us">
        <div class="left">
            <a href="../index.php">
                <img src="../home/imgs/gold-ducks.png" alt="logo">
                <h3>Duck’s ROW</h3>
            </a>
        </div>
        <div class="info">
            <h3>contact us</h3>
            <p>Telephone: <a href="tel:+201556892517">01556892517</a><br>
                Email: <a href="mailto:ducksrow100@gmail.com">ducksrow100@gmail.com</a><br><br>
                <a href="../Privacy&Policy/Privacy&Policy.html" class="privacy">Go to Privacy & Policy</a>
            </p>
        </div>
    </section>
    <script src="popup1.js"></script>
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