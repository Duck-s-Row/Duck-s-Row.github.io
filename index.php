 <?php
  session_start();
  require("connection/connection.php");
  require("Functions/Functions.php");
  // if (isset($_SESSION['user_id'])) {
  $user_data = Get_user_data($con);
  // }

  ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
   <meta charset="UTF-8">
   <meta name="description" content="GO Fun, GO & run">
   <link rel="stylesheet" href="home/CSS_files/hom8.css">
   <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
   <link href="https://fonts.googleapis.com/css2?family=ABeeZee&family=Bebas+Neue&display=swap" rel="stylesheet">
   <link rel="website icon" type="png" href="home/imgs/Logo.png">
   <title>Duck's Row</title>
 </head>

 <body>
   <!-- <div class="loading" id="loader"></div> -->
   <!-- The Start of Navbar section -->
   <header>

     <div class="logo"><a href="#home"><img src="home/imgs/ducks.png" alt=""></a></div>
     <div class="hamburger">
       <div class="line"></div>
       <div class="line"></div>
       <div class="line"></div>
     </div>
     <nav class="nav-bar">
       <ul>
         <li><a href="#home">Home</a></li>
         <?php if (isset($_SESSION['user_id'])) : ?>
           <?php if ($user_data['privilege'] == 1) :  ?>
             <li><a href="dashboard/dashboard.php">Dashboard</a></li>
             <li><a href="request/index.php">Requests</a></li>
           <?php elseif ($user_data['privilege'] == 2 ) : ?>
             <li><a href="request/index.php">Requests</a></li>
           <?php endif; ?>
         <?php endif; ?>
         <li><a href="Hangout/hangout.php">Hangout</a></li> <!-- we could remove this ancher tag link because of using the button  -->
         <li><a href="#services">Services</a></li>
         <!-- <li><a href="Sign_UP/first page/Sign_up.php">My Plans</a></li> -->
         <li><a href="#about_us">About</a></li>
         <?php if (isset($_SESSION['user_id'])) : ?>
           <li><a href="Profile/index.php" class="profile">Profile</a></li>
         <?php else : ?>
           <li><a href="Sign_UP/ThirdPage/regist.php" class="profile">Sign Up</a></li>
           <li><a href="Log_in/index.php" class="profile">Login</a></li>
         <?php endif; ?>
         <li><i class="fa fa-right-from-bracket" id="logout"></i><i class="fa-regular fa-user" onclick="toggleMenu()" id="user-icon"></i></li>
         <div class="dark"><i class='fa-regular fa-moon' style='color: #ffffff;' id='icon'></i></div>
       </ul>

       <div class="sub-menu-wrap" id="subMenu">
         <div class="sub-menu">
           <?php if (isset($_SESSION['user_id'])) : ?>
             <div class="user-info">
               <img src="Profile/user_profile_imgs/<?php echo $user_data['user_pic'] ?>" alt="profile-image">
               <h2><?php echo $user_data['Fname'] . " " . $user_data['Lname']; ?></h2>
             </div>
             <hr>

             <a href="Profile/index.php" class="sub-menu-link">
               <i class="fa-regular fa-user" id="drop-icon"></i>
               <p>Profile page</p>
               <span>></span>
             </a>

             <a href="plans/plans.php" class="sub-menu-link">
               <i class="fa-solid fa-location-dot" id="drop-icon"></i>
               <p>My Plans</p>
               <span>></span>
             </a>

             <a href="Log_out/index.php" class="sub-menu-link">
               <i class="fa fa-right-from-bracket" id="drop-icon"></i>
               <p>Logout</p>
               <span>></span>
             </a>
           <?php else : ?>
             <a href="Sign_UP/ThirdPage/regist.php" class="sub-menu-link">
               <i class="fa fa-registered" id="drop-icon"></i>
               <p>Sign Up</p>
               <span>></span>
             </a>

             <a href="Log_in/index.php" class="sub-menu-link">
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

   <!-- The Start of Home Section -->
   <section class="home" id="home">
     <h1 data-text="Duck's Row">Duck's Row</h1>
     <h2>Go Fun, Go <span>&</span> Run</h2>
     <button onclick="window.location.href = 'Hangout/hangout.php';" class="button">Hangout</button>
   </section>
   <!-- The End of Home Section -->

   <!-- The Start of Services Section -->
   <section class="services" id="services">
     <div class="content">
       <a href="Hangout/hangout.php">
         <div class="card">
           <div class="icon">
             <i class="fa-solid fa-sack-dollar"></i>
           </div>
           <div class="info">
             <h3>Specific budget</h3>
             <p>You can decide on a budget, and we'll show you the appropriate places depending on that.</p>
           </div>
         </div>
       </a>
     </div>
     <div class="content">
       <a href="#about_us">
         <div class="card">
           <div class="icon">
            <i class="fa-solid fa-envelope"></i>
           </div>
           <div class="info">
             <h3>Requests</h3>
             <p>We can assist in expanding your business by featuring your services on our website.</p>
           </div>
         </div>
       </a>
     </div>
     <div class="content">
       <a href="plans/plans.php">
         <div class="card">
           <div class="icon">
             <i class="fa-solid fa-list-check"></i>
           </div>
           <div class="info">
             <h3>Make your plan</h3>
             <p>To visit the locations you add at any moment, you can make your own plan.</p>
           </div>
         </div>
       </a>
     </div>
   </section>
   <!-- The End of services Section -->

   <!-- The Start of About Us section -->
   <section class="about_us" id="about_us">
     <div class="left">
       <h1>Contact us to add your services</h1>
       <form method="post">
         <input type="text" id="name" placeholder="Your name" value="<?php if (isset($_SESSION['user_id'])) echo $user_data['username'] ?>" required>
         <input type="email" id="email" placeholder="Your E-mail" value="<?php if (isset($_SESSION['user_id']))  echo $user_data['email'] ?>" required readonly>
         <textarea id="message" cols="70" rows="10" placeholder="Enter your message" required></textarea>
         <!-- <input type="submit" value="SEND" name="send"> -->
         <button type="button" onclick="sendMail()">SEND</button>
       </form>
       <p id="checking_form" style="margin: 0 0 10px 10%"></p>

     </div>
     <div class="content">
       <h3>About <span>Duck’s Row</span></h3>
       <p>
         Duck's Row is trying to organize your time so you can have fun in various locations while staying inside the limits of your preferred spending limit. <br>We need you to enjoy yourself and go to your favourite destinations.
       </p>
       <div class="icons">
         <a href="#"><i class="fa-brands fa-facebook"></i></a>
         <a href="#"><i class="fa-brands fa-instagram"></i></a>
         <a href="#"><i class="fa-brands fa-twitter"></i></a>
       </div>
       <div class="contact">
         <h3><span>contact</span> us</h3>
         <p>Telephone : <a href="tel:+201556892517">01556892517</a><br>
           Email : <a href="mailto:ducksrow100@gmail.com">ducksrow100@gmail.com</a><br>
         </p>
       </div>


     </div>

   </section>
   <footer>
     <div class="img2">
       <img src="home/imgs/gold-ducks.png" alt="logo" width="60" height="50">
     </div>

     <div class="img1">
       <a href="Privacy&Policy/Privacy&Policy.html" class="privacy">Go to Privacy & Policy</a>
       <img src="home/imgs/pyramids.png" alt="about-us-Photo" width="140" height="120">
     </div>
   </footer>
   <!-- The End of About Us section -->
   <!-- <hr color="#9d8e04"> -->
   <!-- The Start of Contact Us section -->
   <!-- <section class="contact_us" id="contact_us">
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
  </section> -->
   <!-- The End of Contact Us section -->

   <!-- The End of the page -->

   <!-- JS -->
   <script>
     var icon = document.getElementById("icon");
     var divIcon = document.querySelector(".dark")

     divIcon.onclick = function() {
       document.body.classList.toggle("dark-theme")
       if (document.body.classList.contains("dark-theme")) {
         icon.className = "fa-regular fa-sun";
       } else {
         icon.className = "fa-regular fa-moon";
       }
     }
   </script>
   <script src="home/home.js"></script>
   <script src="home/sendmail.js"></script>
 </body>

 </html>