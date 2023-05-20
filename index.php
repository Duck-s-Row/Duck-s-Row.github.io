 <?php
  session_start();
  require("connection/connection.php");
  require("Functions/Functions.php");
  if (isset($_SESSION['user_id'])) {
    $user_data = Get_user_data($con);
  }

  ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
   <meta charset="UTF-8">
   <meta name="description" content="GO Fun, GO & run">
   <link rel="stylesheet" href="home/CSS_files/sttt.css">
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
         <li><a href="Hangout/hangout.php">Hangout</a></li> <!-- we could remove this ancher tag link because of using the button  -->
         <li><a href="#services">Services</a></li>
         <!-- <li><a href="Sign_UP/first page/Sign_up.php">My Plans</a></li> -->
         <li><a href="#about_us">About</a></li>
         <li><a href="Profile/profile.php" class="profile">Profile</a></li>
         <li><i class="fa fa-right-from-bracket" id="logout"></i><i class="fa-regular fa-user" onclick="toggleMenu()" id="user-icon"></i></li>
       </ul>

       <div class="sub-menu-wrap" id="subMenu">
         <div class="sub-menu">
           <?php if (isset($_SESSION['user_id'])) : ?>
             <div class="user-info">
               <img src="Profile/user_profile_imgs/<?php echo $user_data['user_pic']?>" alt="profile-image">
               <h2><?php echo $user_data['Fname'] . " " . $user_data['Lname']; ?></h2>
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
           <?php else : ?>
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

   <!-- The Start of Home Section -->
   <section class="home" id="home">
     <h1>Duck's Row</h1>
     <h2>Go Fun, Go & Run</h2>
     <button onclick="window.location.href = 'Hangout/hangout.php';" class="button">Hangout</button>
   </section>
   <!-- The End of Home Section -->

   <!-- The Start of Services Section -->
   <section class="services" id="services">
   <div class="content">
            <div class="card">
                <div class="icon">
                  <i class="fa-solid fa-sack-dollar"></i>
                </div>
                <div class="info">
                    <h3>Specific budget</h3>
                    <p>You can decide on a budget, and we'll show you the appropriate places depending on that.</p>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="card">
                <div class="icon">
                  <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="info">
                    <h3>Various places</h3>
                    <p>We'll highlight various locations in the Giza Governorate that are appropriate for all groups.</p>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="card">
                <div class="icon">
                  <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="info">
                    <h3>Make your plan</h3>
                    <p>To visit the locations you add at any moment, you can make your own plan.</p>
                </div>
            </div>
        </div>
   </section>
   <!-- The End of services Section -->

   <!-- The Start of About Us section -->
   <section class="about_us" id="about_us">
     <!-- <div class="left">
       <h1>What Can We Offer For You</h1>
       <form method="post">
         <input type="text" placeholder="Your name" name="name">
         <input type="email" placeholder="Your E-mail" name="email">
         <textarea name="message" id="" cols="70" rows="10" placeholder="Enter your message"></textarea>
         <input type="submit" value="SEND" name="send">
         <?php
         
//         if(!empty($_POST["send"])) {
// 	      $userName = $_POST["name"];
//         $userEmail = $_POST["email"];
//       	$userMessage = $_POST["message"];
//       	$toEmail = "ducksrow100@gmail.com";
  
//       	$mailHeaders = "Name: ".$userName."\r\n Email: ". $userEmail ."\r\n Message: " . $userMessage . "\r\n";

// 	    if(mail($toEmail, $userName, $mailHeaders)) {
//         echo "<script>alert('you message have been sent.');</script>"; 
// 	    }
//       else{
//         echo "<script>alert('sorry there have been a problem in sending your message please try again later.');</script>"; 
//       }
// }
?>

       </form>
     </div> -->
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
   <script src="home/app.js"></script>
 </body>

 </html>