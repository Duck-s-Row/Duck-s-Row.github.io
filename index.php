<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <meta charset="UTF-8">
        <meta name="description" content="GO Fun, GO & run">
        <link rel="stylesheet" href="home/CSS_files/home.css">
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css.map">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
              <!-- <li><i class="fa-regular fa-heart"></i></li> -->
              <li><a href="#home">Home</a></li>
              <li><a href="Hangout/hangout.php">Hangout</a></li>
              <li><a href="#services">Services</a></li>
              <li><a href="Sign_UP/first page/Sign_up.php">My Planes</a></li>
              <li><a href="#about_us">About</a></li>
              <li><a href="Profile/profile.php" class="profile">Profile</a></li>
              <li><i class="fa-regular fa-user" onclick="pageRedirect()"></i></li>
            </ul>
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
          function pageRedirect() {
            window.location.href = "Profile/profile.php";
          }
          hamburger.onclick = function() {
            navBar = document.querySelector(".nav-bar");
            navBar.classList.toggle("active");
          }
       </script>
        <script src="js/all.min.js"></script> <!-- font awesome -->
        <script src="js/bootstrap.bundle.min.js"></script> <!-- bootstrap -->
    </body>
</html>