<?php
    include("../../connection/connection.php");
    session_start();
    $place_id =$_SESSION['place_id'];
    $user_id =$_SESSION['user_id'];
    $plan_id =1;

    $Data = "SELECT * FROM places WHERE place_id = $place_id LIMIT 1";
    $result = mysqli_query($con,$Data);
    if($result && mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);   
    }
    //picture query
    $pics_query = "SELECT * FROM place_pics WHERE place_id = $place_id ORDER BY RAND() LIMIT 1";
    $result_pics = mysqli_query($con,$pics_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="../../home/imgs/Logo.png">
    <link rel="stylesheet" href="inofomss.css">
    <title>info</title>
</head>
<body>
<!-- The Start of Navbar section -->
    <header>
        <div class="logo">
            <a href="../hangout.php"><i class="fa-regular fa-circle-left back-arrow"></i></a>
            <a href="../../index.php"><img src="black-duck.png" alt="logo"></a>
        </div>
        
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
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
            <div class="img">  
                <?php while($row_pics = mysqli_fetch_assoc($result_pics)): ?>
                    <img src="../places_imgs/<?php echo $row_pics['photo_name'] ?>" alt="<?php echo $row['p_name'] ?>">
                <?php endwhile; ?>
            </div>
            <div class="disc">
                <div class="map-container">
                    <h2>Location : <?php echo $row['p_branch'] ?></h2>
                    <iframe
                        width="50%"
                        height="200"
                        frameborder="0"
                        scrolling="no"
                        marginheight="0"
                        marginwidth="0"
                        src="https://www.google.com/maps?q=<?php echo urlencode($row['location']); ?>&output=embed"
                        allowfullscreen
                    ></iframe>
                </div>
                <div>
                    <h2><?php echo $row['p_name']; ?></h2>
                    <p><?php echo $row['category']; ?></p>
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
                    <iframe
                        width="50%"
                        height="200"
                        frameborder="0"
                        scrolling="no"
                        marginheight="0"
                        marginwidth="0"
                        src="<?php echo $row['location']; ?>&output=embed"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="btn">
        <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $check_query  = "SELECT COUNT(*) as count FROM user_plans WHERE user_id = '$user_id' AND place_id = '$place_id' AND plan_id = '$plan_id'";
                $check_result = mysqli_query($con, $check_query);
                $check_row = mysqli_fetch_assoc($check_result);
                if ($check_row['count'] > 0) {
                    echo "<script>alert('The Place already exists in your plan')</script>";
                }
                else {
                    $plans = "INSERT INTO user_plans (plan_id, user_id, place_id) VALUES ('$plan_id', '$user_id', '$place_id')";
                    mysqli_query($con,$plans);
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
                <div>
                    <label for="plane_name">Plan Name</label>
                    <input type="text" name="plane_name">
                </div>
                <div>
                    <label for="plane_date">Plan Date</label>
                    <input type="date" name="plane_date">
                </div>
                <input type="submit" name="add_plan" value="add plan">
            </form>

            <form method="post" class="expopform">
                <h2>Exists Plans</h2>
                <a href="#">
                    <div class="plan_card" id="open">
                        <h3>Plan Name</h3>
                        <h3>Average: 200</h3>
                    </div>
                </a>
                <a href="#">
                    <div class="plan_card" id="open">
                        <h3>Plan Name</h3>
                        <h3>Average: 200</h3>
                    </div>
                </a>
                <a href="#">
                    <div class="plan_card" id="open">
                        <h3>Plan Name</h3>
                        <h3>Average: 200</h3>
                    </div>
                </a>
            </form>
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
    <script src="apps.js"></script>
</body>
</html>