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
    <link rel="stylesheet" href="hang.css">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
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
                <li><a href="../Profile/profilee.php">My plans</a></li>
                <!-- <li><a href="Sign_UP/first page/Sign_up.php">My Planes</a></li> -->
                <li><a href="#contact_us">About</a></li>
                <li><a href="../Profile/profilee.php" class="profile">Profile</a></li>
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
                    foreach ($places as $place) :
                    ?>
                        <div class="card">
                            <img src="logos/<?php echo $place['logo'] ?>" alt="Logo Picture">
                            <div class="text1">
                                <h1><?php echo $place['p_name'] ?></h1>
                                <div class="dis">
                                    <p>
                                        <?php echo $place['category'] ?>
                                    </p>
                                </div>
                                <h6>Average: </h6>
                                <?php echo $place['average_budget'] ?>
                            </div>
                            <div class="location-text">
                                <i class="fa-solid fa-location-dot"></i>
                                <p><?php echo $place['p_branch'] ?></p>
                            </div>
                            <div class="more">
                                <form method="POST">
                                    <input type="hidden" name="place_id" value="<?php echo $place['place_id']; ?>">
                                    <input type="submit" name="more" id="more" value="More">
                                </form>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="budget">
                <h1>Your Max budget / Person</h1>
                <input type="range" class="range" name="budget" min="100" max="1000" step="100" value="500" onchange="rangeChange(this.value)">
                <span id="rangeVlaue">500</span>
            </div>
            <hr>
            <div class="food-services">
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
</body>

</html>
<script src="hangoutt.js"></script>