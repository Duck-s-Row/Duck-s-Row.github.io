<?php
session_start();
include("../connection/connection.php");
include("../Functions/Functions.php");
  $_SESSION;
  $user_data = check_login($con);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="hangout.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css.map">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&family=Bebas+Neue&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <link rel="website icon" type="png" href="../home/imgs/Logo.png">
    <title>Hangout</title>
</head>
<body>
    <!-- The Start of Navbar section -->
    <header>
        <nav class="navbar navbar-expand-lg p-3 lg-bottom">
            <div class="container">
                <a class="navbar-brand" href="#">
                <img src="../home/imgs/ducks.png" alt="logo" width="60px" id="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link p-lg-3" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link p-lg-3" aria-current="page" href="../Profile/profile.php">My Plans</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link p-lg-3" aria-current="page" href="#contact_us">Contact Us</a>
                        </li>
                    </ul>
                    <div class="user" id="user">
                        <a href="../Log_in/login.php">
                            <i id="user" class="fa-regular fa-user"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- The End of Navbar section -->

    <!-- The Start of Hangout Section -->
    <section class="hang" id="hangout">
    <div class="left">
        <div class="filters">
        <form>
            <label for="sort">Sort by</label>
            <select id="sort" name="sort">
                <option value="top-rating">Top rating</option>
                <option value="low-rating">Low rating</option>
            </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="date">At any day?</label>
            <input type="date" name="date" id="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="number"><i class="fa-solid fa-user-group"></i></label>
            <input type="number" name="number" id="number" min="1" max="10" value="1">
        </form>
        </div>
        <div class="choices">
            <div class="f_row">

                <div class="card">
                    <img src="imgs/Rectangle 38 (1).png" alt="">
                    <div class="text1">
                    <h1>Dunkin donate</h1>
                    <h2>no of Viewers</h2>
                    <ul>
                        <li><i class="fa fa-check"></i> Have a good offers</li>
                        <li><i class="fa fa-check"></i> Make Coffee & Donuts</li>
                        <li><i class="fa fa-check"></i> Have a good service</li>
                    </ul>
                    </div>
                    <!-- <hr>
                    <div class="location-text">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>New Cairo Galleria Mall, South Teseen St, Near AUC</p>
                    </div> -->
                    <button class="location" id="more">More</button>
                </div>
                <div class="card">
                    <img src="imgs/Rectangle 38.png" alt="">
                    <div class="text1">
                    <h1>Dunkin donate</h1>
                    <h2>no of Viewers</h2>
                    <ul>
                        <li><i class="fa fa-check"></i> Have a good offers</li>
                        <li><i class="fa fa-check"></i> Make Coffee & Donuts</li>
                        <li><i class="fa fa-check"></i> Have a good service</li>
                    </ul>
                    </div>
                    <!-- <hr>
                    <div class="location-text">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>New Cairo Galleria Mall, South Teseen St, Near AUC</p>
                    </div> -->
                    <button class="location">More</button>
                </div>
            </div>

            <div class="f_row">
                <div class="card">
                    <img src="imgs/Rectangle 38.png" alt="">
                    <div class="text1">
                    <h1>Dunkin donate</h1>
                    <h2>no of Viewers</h2>
                    <ul>
                        <li><i class="fa fa-check"></i> Have a good offers</li>
                        <li><i class="fa fa-check"></i> Make Coffee & Donuts</li>
                        <li><i class="fa fa-check"></i> Have a good service</li>
                    </ul>
                    </div>
                    <!-- <hr>
                    <div class="location-text">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>New Cairo Galleria Mall, South Teseen St, Near AUC</p>
                    </div> -->
                    <button class="location">More</button>
                </div>
                <div class="card">
                    <img src="imgs/Rectangle 38 (1).png" alt="">
                    <div class="text1">
                    <h1>Dunkin donate</h1>
                    <h2>no of Viewers</h2>
                    <ul>
                        <li><i class="fa fa-check"></i> Have a good offers</li>
                        <li><i class="fa fa-check"></i> Make Coffee & Donuts</li>
                        <li><i class="fa fa-check"></i> Have a good service</li>
                    </ul>
                    </div>
                    <!-- <hr>
                    <div class="location-text">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>New Cairo Galleria Mall, South Teseen St, Near AUC</p>
                    </div> -->
                    <button class="location">More</button>
                </div>
                
                </div>
                <!-- <div class="duckph">
                    <img src="duck.png" alt="" width="100" height="100">
                </div> -->
                
            </div>
    </div>
    <div class="right">
        <div class="budget">        
            <h1>Your Max budget</h1>
            <input type="range" name="budget" class="budget-range" id="budget-range" min="100" max="1000" step="50">
            <!-- <button onclick="myfun()">Try it</button> -->
            <p id="demo">fd</p>
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
                <textarea type="text-box" placeholder="Add a comment about that place" maxlength ="120"></textarea>
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
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js.map"></script>
    <script src="hangout.js"></script>
</body>
</html>