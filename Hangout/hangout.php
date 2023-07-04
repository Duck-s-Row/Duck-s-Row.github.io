<?php
session_start();
include("../connection/connection.php");
include("../Functions/Functions.php");
$user_data = check_login($con);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $place_id = $_POST['place_id'];
    $_SESSION['place_id'] = $place_id;
    header('Location:infopage/info.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="h11.css">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="website icon" type="png" href="../home/imgs/Logo.png">
    <title>Hangout</title>
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
                    <li><a href="../request/index.php">Requests</a></li>
                <?php elseif ($user_data['privilege'] == 2) : ?>
                    <li><a href="../request/index.php">Requests</a></li>
                <?php endif; ?>
                <li><a href="../plans/plans.php">My Plans</a></li>
                <!-- <li><a href="Sign_UP/first page/Sign_up.php">My Planes</a></li> -->
                <li><a href="#contact_us">About</a></li>
                <li><a href="../Profile/profile.php" class="profile">Profile</a></li>
            </ul>
        </nav>
    </header>
    <!-- The End of Navbar section -->

    <!-- The Start of Hangout Section -->
    <section class="hang" id="hangout">
        <div class="left">
            <form class="filters">
                <div>
                    <label for="sort">Sort by</label>
                    <select id="sort" name="sort">
                        <option value="">Random</option>
                        <option value="top-Average">Top Average</option>
                        <option value="low-Average">Low Average</option>
                    </select>
                </div>
                <div>
                    <label for="p_branch">Location</label>
                    <select id="p_branch" name="p_branch">
                        <optgroup label="GIZA">
                            <option value="">All in Giza</option>
                            <?php
                            $select_all_locations = "SELECT DISTINCT p_branch from places";
                            $result = mysqli_query($con, $select_all_locations);
                            while ($row = mysqli_fetch_assoc($result)) :
                            ?>
                                <option value="<?php echo $row['p_branch'] ?>"><?php echo $row['p_branch'] ?></option>
                            <?php endwhile; ?>
                        </optgroup>
                    </select>
                </div>
            </form>

            <div class="choices">
                <div class="f_row">
                    <?php
                    $places = getAllplaces($con);
                    $count = 0;
                    foreach ($places as $place) :
                    ?>
                        <div class="card">
                            <div class="card2">
                                <img src="logos/<?php echo $place['logo'] ?>" alt="Logo Picture">
                                <div class="text1">
                                    <h1><b><?php echo $place['p_name'] ?></b></h1>
                                    <div class="dis">
                                        <p>
                                            <?php echo $place['category'] ?><br>
                                        </p>
                                    </div>
                                    <h6>Average: <br><?php echo $place['average_budget'] ?><br>
                                        <!--  start rating line -->
                                        <?php
                                        $sql = "SELECT user_rating from review_table WHERE place_id=" . $place['place_id'] . ";";
                                        $result3 = $con->query($sql);
                                        $average_rating = 0;
                                        $total_review = 0;
                                        $five_star_review = 0;
                                        $four_star_review = 0;
                                        $three_star_review = 0;
                                        $two_star_review = 0;
                                        $one_star_review = 0;
                                        $total_user_rating = 0;
                                        if ($result3->num_rows > 0) {
                                            $total = 0;
                                            $number = $result3->num_rows * 5;
                                            while ($row = $result3->fetch_assoc()) {

                                                if ($row["user_rating"] == '5') {
                                                    $five_star_review++;
                                                }

                                                if ($row["user_rating"] == '4') {
                                                    $four_star_review++;
                                                }

                                                if ($row["user_rating"] == '3') {
                                                    $three_star_review++;
                                                }

                                                if ($row["user_rating"] == '2') {
                                                    $two_star_review++;
                                                }

                                                if ($row["user_rating"] == '1') {
                                                    $one_star_review++;
                                                }

                                                $total_review++;

                                                $total_user_rating = $total_user_rating + $row["user_rating"];
                                            }

                                            $average_rating = $total_user_rating / $total_review;

                                            if ($average_rating <= 0) {
                                                echo "Rating = 0";
                                            } else {
                                                echo "Rating = " . (round($average_rating, 1)) . " / 5 &#10029;";
                                            }
                                        }


                                        ?>
                                        <!-- end of rating line -->
                                    </h6>

                                    <div class="location-text">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <p><?php echo $place['p_branch'] ?></p>
                                    </div>
                                </div>
                                <div class="text2">
                                    <!-- <div class="more"> -->
                                    <form method="POST" id="hidden_form_<?php echo $place['place_id']; ?>" style="display: none;">
                                        <input type="hidden" name="place_id" value="<?php echo $place['place_id']; ?>">
                                        <input type="submit" name="more" id="more" value="More">
                                    </form>
                                    <!-- </div> -->
                                    <div class="icons">
                                        <a href="" onclick="event.preventDefault(); document.getElementById('hidden_form_<?php echo $place['place_id']; ?>').submit();"><i class="fa-solid fa-eye"></i></a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        $count++;
                        if ($count % 2 == 0) {
                            echo '</div><div class="f_row">';
                        }
                    endforeach;
                    ?>
                </div>

            </div>
            <!-- <div class="see-more" id="see-more">
                    See More
            </div> -->
        </div>
        <div class="right">
            <div class="food-services">
                <label for="budget">Maximum Average Budget / Place</label>
                <select id="budget" name="budget">
                    <option value="">All</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="500">500</option>
                    <option value="750">750</option>
                    <option value="1000">1000</option>
                    <option value="2000">2000</option>
                </select>
                <hr>
                <form method="POST">
                    <label for="food" class="food">Food & Services</label><br>
                    <?php
                    $select_category = "SELECT DISTINCT category FROM places";
                    $result_category = mysqli_query($con, $select_category);
                    while ($row_category = mysqli_fetch_assoc($result_category)) :
                    ?>
                        <label><input type="checkbox" name="category[]" value="<?php echo $row_category['category'] ?>"><?php echo $row_category['category'] ?></label><br>
                    <?php endwhile; ?>
                </form>
            </div>
            <!-- Start of offers section  -->
            <div class="offers">
                <img src="offers/264439926.jpg" alt="" id="image">
            </div>
            <!-- End of offers section  -->
        </div>
    </section>
    <!-- The End of Hangout Section -->

    <!-- The Start of Contact Us section -->
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
    <!-- The End of Contact Us section -->

    <footer>
        <a href="#"><i class="fa fa-arrow-up"></i></a>
    </footer>

    <!-- see more button -->
    <!-- <script>
        $(document).ready(function(){
            $(".card").slice(0, 6).fadeIn();

            let loadMoreBtn = document.querySelector('#see-more');
            let currentItem = 6;
            loadMoreBtn.onclick = () =>{
            let boxes = [...document.querySelectorAll('.hang .left .choices .f_row .card')];
            for (var i = currentItem; i < currentItem + 8; i++){
                if (boxes[i]) {
                    boxes[i].style.display = 'inline-block';
                }
            }
            currentItem += 8;
            if (currentItem >= boxes.length) {
                loadMoreBtn.style.display = 'none';
            }
        }});
    </script> -->

    <script src="filter2.js"></script>

    <!-- offers images -->
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
            image.src = 'offers/' + images[random];
        }, 2000);

        hamburger = document.querySelector(".hamburger");
        home = document.getElementById("home");
        contact_us = document.getElementById("contact_us");
        about_us = document.getElementById("about_us");
        services = document.getElementById("services");

        navBar = document.querySelector(".nav-bar");

        let subMenu = document.getElementById("subMenu");

        // Add the open menu class
        function toggleMenu() {
        subMenu.classList.toggle("open-menu");
        }
        // Add the navigation bar active class
        hamburger.onclick = function() {
        navBar.classList.toggle("active");
        }
    </script>
</body>

</html>