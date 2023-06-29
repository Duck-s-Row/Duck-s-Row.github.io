<?php
include("../../Functions/Functions.php");
require("../../connection/connection.php");
session_start();
$place_id = $_SESSION['place_id'];
$user_id = $_SESSION['user_id'];
$user_data = Get_user_data($con);
//make the user must login to enter here first
if (!isset($user_id))
    header("Location:../../Log_in/login.php");


$Data = "SELECT * FROM places WHERE place_id = $place_id LIMIT 1";
$result = mysqli_query($con, $Data);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}
//picture query
$pics_query2 = "SELECT * FROM place_pics WHERE place_id = $place_id ORDER BY RAND() ";

// $pics_query = "SELECT * FROM place_pics WHERE place_id = $place_id ORDER BY RAND() LIMIT 1";

$result_pics2 = mysqli_query($con, $pics_query2);

// $result_pics = mysqli_query($con,$pics_query);

$Data = "SELECT * FROM places WHERE place_id = $place_id LIMIT 1";
$result = mysqli_query($con, $Data);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}
//picture query
$pics_query = "SELECT * FROM place_pics WHERE place_id = $place_id ORDER BY RAND() LIMIT 1";
$result_pics = mysqli_query($con, $pics_query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="../../home/imgs/Logo.png">
    <!-- <link rel="stylesheet" href="inofomss.css"> -->
    <link rel="stylesheet" href="i3.css">
    <title>info</title>
</head>

<body>
    <!-- The Start of Navbar section -->
    <header>
        <div class="logo">
            <a onclick="window.history.back()"><i class="fa-regular fa-circle-left back-arrow"></i></a>
            <a href="../../index.php"><img src="black-duck.png" alt="logo"></a>
        </div>

        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <?php if ($user_data['privilege'] == 1) :  ?>
                    <li><a href="../../dashboard/dashboard.php"><b>Dashboard</b></a></li>
                <?php endif; ?>
                <li><a href="../../index.php"><b>Home</b></a></li>
                <li><a href="../../plans/plans.php"><b>My plans</b></a></li>
                <!-- <li><a href="Sign_UP/first page/Sign_up.php">My Planes</a></li> -->
                <li><a href="#contact_us"><b>About</b></a></li>
                <li><a href="../../Profile/profile.php" class="profile"><b>Profile</b></a></li>
            </ul>
        </nav>
    </header>
    <!-- The End of Navbar section -->
    
    <section class="main">
        <div class="photo">

            <!--  image class -->
            <div class="main_slide">
                <div class="slider-container">
                    <div id="slide-number" class="slide-number"></div>
                    <?php
                    if ($result_pics2->num_rows > 0) {
                        while ($row_pics = $result_pics2->fetch_assoc()) :
                            // $imageURL = '../places_imgs/'.$row_pics['photo_name']; 
                    ?>
                            <img src="../places_imgs/<?php echo $row_pics['photo_name'] ?>" alt="<?php echo $row['p_name'] ?>">
                    <?php endwhile;
                    }  ?>
                </div>

                <div class="slider-controls">
                    <span id="prev" class="prev"><i class="fa-solid fa-circle-arrow-left"></i></span>
                    <span id="indicators" class="indicators"></span>
                    <span id="next" class="next"><i class="fa-solid fa-circle-arrow-right"></i></span>
                </div>
            </div>
            <!-- js for slide  -->
            <script src="slider.js"></script>

            <div class="disc">
                <div>
                    <h2><?php echo $row['category']; ?></h2>
                    <p><?php echo $row['p_name']; ?></p>
                </div>
                <div class="box">
                    <div class="box1">
                        <div>
                            <h2>Budget</h2>
                            <p><?php echo $row['min_price'] ?>-<?php echo $row['max_price'] ?> L.E/Person</p>
                            <h2>Average</h2>
                            <p><?php echo $row['average_budget']; ?></p>
                        </div>
                    </div>
                    <div class="box2">
                        <div>
                            <h2>Details</h2>
                            <p><?php echo $row['more_details'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="map-container">
                    <h2>Location : <?php echo $row['p_branch'] ?></h2>
                    <iframe width="50%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $row['location']; ?>&output=embed" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <footer class="btn">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['Form_identifier'] == 'add_new') {
                $plan_id = random_num(5);
                $creation_date = date('Y-m-d H:i:s');

                //check if the plan name is empty 
                if (empty($_POST['plan_name'])) {
                    $plan_name = "plan";
                } else {
                    $plan_name = $_POST['plan_name'];
                }

                //check if the plan date is empty 
                if (empty($_POST['plan_date'])) {
                    $plan_date = date('Y-m-d');
                } else {
                    $plan_date = $_POST['plan_date'];
                }

                $query2 = "INSERT INTO user_plans(plan_id,plan_name,plan_date,creation_date,user_id) VALUES(?,?,?,?,?)";
                $stmt2 = mysqli_prepare($con, $query2);
                mysqli_stmt_bind_param($stmt2, 'issss', $plan_id, $plan_name, $plan_date, $creation_date, $user_id);
                mysqli_stmt_execute($stmt2);

                $query1 = "INSERT INTO exist_plan(plan_id,user_id,place_id) VALUES(?,?,?)";
                $stmt1 = mysqli_prepare($con, $query1);
                mysqli_stmt_bind_param($stmt1, 'iii', $plan_id, $user_id, $place_id);
                mysqli_stmt_execute($stmt1);

                header("Location:info.php");
                // }
            }
        }
        ?>

        <button class="open" id="open">+ Add to my plans</button>
    </footer>

    <section class="popup" id="popup">
        <button id="close"><i class="fa fa-x"></i></button>
        <div class="popup_content" id="popup_content">
            <button class="plan_form_btn" id="plan_form_btn">New Plan</button>
            <form method="post" class="addpopform" id="addpopform">
                <input type="hidden" name="Form_identifier" value="add_new">
                <div>
                    <label for="plane_name">Plan Name</label>
                    <input type="text" name="plan_name">
                </div>
                <div>
                    <label for="plane_date">Plan Date</label>
                    <input type="date" name="plan_date">
                </div>
                <input type="submit" value="add plan">
            </form>
            <?php
            $selectAllPlans = "SELECT * FROM user_plans WHERE user_id = $user_id";
            $allPlans = mysqli_query($con, $selectAllPlans);
            ?>
            <!-- <form method="post" class="expopform"> -->
            <?php if (mysqli_num_rows($allPlans)) : ?>
                <h2>Exists Plans</h2>
                <?php while ($eachPlan = mysqli_fetch_assoc($allPlans)) : ?>
                    <a href="#" class="plan-card-link" data-planid="<?php echo $eachPlan['plan_id'] ?>">
                        <div class="plan_card" id="open">
                            <h3><?php echo $eachPlan['plan_name'] ?></h3>
                            <h3><?php echo $eachPlan['plan_date'] ?></h3>
                        </div>
                    </a>
                <?php endwhile; ?>
            <?php else : ?>
                <h2>You didn't make any plans yet Please make new one.</h2>
            <?php endif; ?>
            <!-- </form> -->
            <!-- <form method="post">
                <input type="submit" name="plans" value="+ Add to my plans " class="button">
            </form> -->
        </div>
    </section>

    <!-- The Start of Contact Us section -->
    <section class="contact_us" id="contact_us">
        <div class="left">
            <a href="../../index.php">
                <img src="black-duck.png" alt="logo">
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
    <!-- The End of Contact Us section -->
    <script src="apps.js"></script> <!-- script for pop up page -->
    <script src="add_exist_plan.js"></script> <!-- script for the ajax of adding to an exist plan -->
</body>

</html>