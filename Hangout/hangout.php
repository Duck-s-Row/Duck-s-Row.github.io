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
    <link rel="stylesheet" href="hanggggggل.css">
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
                        <option value="" hidden></option>
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
                                    <h6>Average: <br><?php echo $place['average_budget'] ?></h6>
                                    <div class="location-text">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <p><?php echo $place['p_branch'] ?></p>
                                    </div>
                                </div>
                                <div class="more">
                                    <form method="POST">
                                        <input type="hidden" name="place_id" value="<?php echo $place['place_id']; ?>">
                                        <input type="submit" name="more" id="more" value="More">
                                    </form>
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
            <div class="see-more" id="see-more">
                See More
            </div>
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
            <div class="offers">
                <img src="" alt="" id="image">
            </div>
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
    <script>
        let image = document.getElementById('image');
        let images = ['mcdonalds.jpg','buffalo.png','bazooka.jpg']
        setInterval(function(){
            let random = Math.floor(Math.random() * 3);
            image.src = images[random];
        }, 2000);
    </script>
    <script src="filterss.js"></script>
</body>
</html>