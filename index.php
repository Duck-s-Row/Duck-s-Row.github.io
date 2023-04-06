<?php
session_start();
include("connection/connection.php");
include("Functions/Functions.php");
$_SESSION;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
  <meta charset="UTF-8">
  <meta name="description" content="GO Fun, GO & run">
  <link rel="stylesheet" href="home/CSS_files/home.css">
  <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=ABeeZee&family=Bebas+Neue&display=swap" rel="stylesheet">
  <link rel="website icon" type="png" href="home/imgs/Logo.png">
  <title>Duck's Row</title>
</head>

<body>
  <!-- The Start of Navbar section -->
  <header>
    <div class="logo"><img src="home/imgs/ducks.png" alt=""></div>
    <div class="hamburger">
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
    </div>
    <nav class="nav-bar">
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="Hangout/hangout.php">Hangout</a></li>
        <li><a href="#services">Services</a></li>
        <!-- <li><a href="Sign_UP/first page/Sign_up.php">My Planes</a></li> -->
        <li><a href="#about_us">About</a></li>
        <li><a href="Profile/profile.php" class="profile">Profile</a></li>
        <li><i class="fa fa-right-from-bracket" id="logout"></i><i class="fa-regular fa-user" onclick="toggleMenu()" id="user-icon"></i></li>
      </ul>

      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
<?php if(isset($_SESSION['user_id'])): ?>
          <div class="user-info">
            <img src="/Profile/kareem.jpg" alt="profile-image">
            <h2>Kareem abdallah</h2>
          </div>
          <hr>

          <a href="Profile/profile.php" class="sub-menu-link">
            <i class="fa-regular fa-user" id="drop-icon"></i>
            <p>Profile page</p>
            <span>></span>
          </a>

          <a href="Log_out/logout.php" class="sub-menu-link">
            <i class="fa fa-right-from-bracket" id="drop-icon"></i>
            <p>Logout</p>
            <span>></span>
          </a>
<?php else: ?>
          <a href="Sign_UP/ThirdPage/regist.php" class="sub-menu-link">
            <i class="fa fa-registered" id="drop-icon"></i>
            <p>Sign Up</p>
            <span>></span>
          </a>

          <a href="Log_in/login.php" class="sub-menu-link">
            <i class="fa fa-lock" id="drop-icon"></i>
            <p>Login</p>
            <span>></span>
          </a>
<?php endif; ?>
        </div>
      </div>
    </nav>
  </header>
  <!-- The End of Navbar section -->

  <!-- logout button/link -->
  <!-- <a href="Log_out">logout</a> -->

  <!-- The Start of Home Section -->
  <section class="home" id="home">
    <h1>Duck's Row</h1>
    <h2>Go Fun, Go & Run</h2>
    <button onclick="window.location.href = 'Hangout/hangout.php';" class="button">Hangout</button>
  </section>
  <!-- The End of Home Section -->

  <!-- The Start of Services Section -->
  <section class="services" id="services">
    <div class="cards">
      <div class="pra">
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio dolores, voluptas voluptatibus deserunt praesentium quo maxime ipsa eaque? Consequuntur, eveniet </p>
      </div>
      <div class="btn">
        <button>See More</button>
      </div>
    </div>
    <div class="cards">
      <div class="pra">
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio dolores, voluptas voluptatibus deserunt praesentium quo maxime ipsa eaque? Consequuntur, eveniet </p>
      </div>
      <div class="btn">
        <button>See More</button>
      </div>
    </div>
    <div class="cards">
      <div class="pra">
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio dolores, voluptas voluptatibus deserunt praesentium quo maxime ipsa eaque? Consequuntur, eveniet </p>
      </div>
      <div class="btn">
        <button>See More</button>
      </div>
    </div>
  </section>
  <!-- The End of services Section -->

  <!-- The Start of About Us section -->
  <section class="about_us" id="about_us">
    <img src="home/imgs/about_us.jpg" alt="about-us-Photo">
    <div class="content">
      <h3>About <span>Duck’s Row</span></h3>
      <p>
        Duck's Row is trying to organize your time so you can have fun in various locations while staying inside the limits of your preferred spending limit. <br>We need you to enjoy yourself and go to your favourite destinations.
      </p>
    </div>
  </section>
  <!-- The End of About Us section -->

  <!-- The Start of Contact Us section -->
  <section class="contact_us" id="contact_us">
    <div class="left">
      <img src="home/imgs/gold-ducks.png" alt="logo">
      <h3>Duck’s ROW</h3>
    </div>
    <div class="info">
      <h3>contact us</h3>
      <p>Telephone: <a href="tel:+201556892517">01556892517</a><br>
        Email: <a href="mailto:ducksrow100@gmail.com">ducksrow100@gmail.com</a><br><br>
        <a href="Privacy&Policy/Privacy&Policy.html" class="privacy">Go to Privacy & Policy</a>
      </p>
    </div>
  </section>
  <!-- The End of Contact Us section -->

  <!-- The End of the page -->

  <!-- JS -->
  <script>
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

    // Remove the navigation bar active class and the open menu class
    home.onclick = function() {
      navBar.classList.remove("active");
      subMenu.classList.remove("open-menu");
    }
    about_us.onclick = function() {
      navBar.classList.remove("active");
      subMenu.classList.remove("open-menu");
    }
    contact_us.onclick = function() {
      navBar.classList.remove("active");
      subMenu.classList.remove("open-menu");
    }
    services.onclick = function() {
      navBar.classList.remove("active");
      subMenu.classList.remove("open-menu");
    }
  </script>
  <script src="js/all.min.js"></script> <!-- font awesome -->
  <script src="js/bootstrap.bundle.min.js"></script> <!-- bootstrap -->
</body>

</html>