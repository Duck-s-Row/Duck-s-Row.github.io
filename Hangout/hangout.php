<?php
session_start();
include("../connection/connection.php");
include("../Functions/Functions.php");
$user_data = check_login($con);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="hangout.css">
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
                                    <option value="<?php echo $row['p_branch']?>"><?php echo $row['p_branch'] ?></option>
                            <?php endwhile; ?>
                        </optgroup>
                    </select>
                </div>
            </form>
            <div class="choices">
                <div class="f_row">
                    <?php
                    $places = getAllplaces($con,"haram");
                    foreach ($places as $place) :
                    ?>
                        <div class="card">
                            <img src="logos/<?php echo $place['logo'] ?>" alt="Logo Picture">
                            <div class="text1">
                                <h1><?php echo $place['p_name'] ?></h1>
                                <p>
                                    <?php echo $place['details'] ?>
                                </p>
                                <h6>Average: </h6>
                                <?php echo $place['average_budget'] ?>
                            </div>
                            <hr>
                            <div class="location-text">
                                <i class="fa-solid fa-location-dot"></i>
                                <p><?php echo $place['p_branch'] ?></p>
                            </div>
                            <button class="location" id="more">More</button>
                        </div>
                    <?php
                    endforeach;
                    ?>
                    
                </div>
            </div>
        </div>
        <div class="right">
            <div class="budget">
                <h1>Your Max budget / Persone</h1>
                <input type="range" class="range" name="budget" min="100" max="1000" step="100" value="500" onchange="rangeChange(this.value)">
                <span id="rangeVlaue">500</span>
            </div>
            <hr>
            <div class="food-services">
                <form>
                    <label for="food" class="food">Food & Services</label><br>
                    <input type="checkbox" name="food" id="cafe" value="cafe"> <label for="cafe">Cafe</label><br>
                    <input type="checkbox" name="food" id="restaurant" value="restaurant"><label for="restaurant">Restaurants</label><br>
                    <input type="checkbox" name="food" id="park" value="park"><label for="park">Park</label><br>
                    <input type="checkbox" name="food" id="museum" value="museum"><label for="museum">Museums</label><br>
                </form>
            </div>
        </div>
    </section>
    <!-- The End of Hangout Section -->

    <!-- The Start of Popup page  -->
    <section class="popup" id="popup">
        <div class="popup-content">
            <img src="imgs/exit.png" alt="exit" id="exit" class="exit">
            <img src="imgs/Find-a-Restaurant.jpg" alt="photo" class="popup-image">
            <div class="content">
                <h2>Macdonald's</h2>
                <p>McDonald's Corporation is an American multinational fast food chain, founded in 1940 as a restaurant operated by Richard and Maurice McDonald, in San Bernardino, California, United States.</p>
            </div>

            <div class="pop-budget">
                <h3>Budget</h3>
                <p>70 EG - 300 EG <br> per persone</p>
            </div>
            <div class="pop-Capacity">
                <h3>Capacity</h3>
                <p>1 - 50 <br>persones</p>
            </div>
            <div class="pop-More-details">
                <h3>More details</h3>
                <ul>
                    <li>Breakfast</li>
                    <li>Lunch</li>
                    <li>McCafé</li>
                    <li>Happy meal</li>
                </ul>
            </div>
            <div class="rating">
                <div class="stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-stroke"></i>
                </div>
                <div>98% satisfied</div>
            </div>
            <div class="pop-rate">
                <h3>Rate that place</h3>
                <span>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </span>
                <textarea type="text-box" placeholder="Add a comment about that place" maxlength="120"></textarea>
                <div class="send">
                    <button type="submit" class="send-comment">Send</button>
                </div>
            </div>
            <div class="more-comments">
                <h3>the best comment</h3>
                <span>profile name</span>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde odio accusantium distinctio incidunt corporis cupiditate.</p>
            </div>
            <div class="plans">
                <button class="add-plan">Add to my planes</button>
            </div>
        </div>
    </section>
    <!-- The End of Popup page  -->

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
    <script src="hangout.js"></script>
</body>

</html>