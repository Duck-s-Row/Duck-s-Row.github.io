<?php
require("../../connection/connection.php");
require('../../Functions/Functions.php');
session_start();
if (isset($_SESSION['user_id'])) {
    $user_data = Get_user_data($con);
    if ($user_data['privilege'] != 1 && $user_data['privilege'] != 2) {
        header('Location:../../index.php');
    }
} else {
    //redirect to login page
    header("Location: ../../Log_in/login.php");
    die;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="request1.css">
    <link rel="website icon" type="png" href="../../home/imgs/Logo.png">
    <title>New Request</title>
</head>

<body>
    <!-- The Start of Navbar section -->
    <header>
        <div class="logo"><a href="../../index.php"><img src="../../home/imgs/ducks.png" alt=""></a></div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="../../index.php"><b>Home</b></a></li>
                <li><a href="../../plans/plans.php"><b>My Plans</b></a></li>
                <li><a href="../index.php"><b>Requests</b></a></li>
                <!-- <li><a href="Sign_UP/first page/Sign_up.php">My Planes</a></li> -->
                <li><a href="#contact_us"><b>About</b></a></li>
                <li><a href="../../Profile/profile.php" class="profile"><b>Profile</b></a></li>
            </ul>
        </nav>
    </header>
    <!-- The End of Navbar section -->
    <form action="send_data.php" method="post" enctype="multipart/form-data">
        <section class="main">
            <div class="photo">
                <h2>Logo of the Place (optional)</h2>
                <input type="file" name="logo" accept=".jpg, .png, .jpeg">
                <h2>Photos of the Place (choose one or more pictures)</h2>
                <input type="file" name="image[]" multiple accept=".jpg, .png, .jpeg" required>
                <h2>Menu of the Place (optional)</h2>
                <input type="file" name="menu" accept=".jpg, .png, .jpeg">
            </div>
            <div class="disc">
                <div>
                    <h2>Place Name</h2>
                    <input type="text" name="p_name" placeholder="Enter place name" required>
                    <h2>Category</h2>
                    <select name="category" id="category" required>
                        <option value="Cafe">Cafe</option>
                        <option value="Restaurants">Restaurants</option>
                        <option value="Park">Park</option>
                        <option value="Museums">Museums</option>
                        <option value="Mall">Mall</option>
                        <option value="Cinema">Cinema</option>
                        <option value="EscapeRoom">Escape Rooms</option>
                    </select><br>
                </div>
                <div class="box">
                    <div class="box1">
                        <div>
                            <h2>Budget</h2>
                            <p><input type="number" name="min" id="min" placeholder="min price" required> - <input type="number" name="max" id="max" placeholder="max price" required> L.E/Person</p>
                        </div>
                    </div>
                    <div id="average">
                        <h2>Average</h2>
                        <p><span id="avr"></span> L.E.</p>
                    </div>
                    <div class="box2">
                        <div>
                            <h2>Details</h2>
                            <textarea name="details" placeholder="Enter more details" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="map-container">
                    <h2>Place Branch</h2>
                    <select id="p_branch" name="p_branch" required>
                        <optgroup label="GIZA">
                            <option value="haram">haram</option>
                            <option value="fisal">fisal</option>
                            <option value="el doki">el doki</option>
                            <option value="zamalek">zamalek</option>
                            <option value="6th october">6th october</option>
                            <option value="el shiekh zayed">el shiekh zayed</option>
                            <option value="el mohandseen">el Mohandseen</option>
                            <option value="el manial">el Manial</option>
                        </optgroup>
                    </select><br>
                    <h2>i Frame src Location : </h2>
                    <input type="text" name="location" placeholder="Enter location URL" required>
                </div>
                <input type="submit" value="Request" class="submit_request">
            </div>
        </section>
    </form>
    <script>
        const minInput = document.getElementById('min');
        const maxInput = document.getElementById('max');
        const avrSpan = document.getElementById('avr');

        const min = parseFloat(minInput.value);
        const max = parseFloat(maxInput.value);

        const average = (min + max) / 2;

        console.log(average);
        console.log("----------");
        console.log(average.toFixed(2));

        if(isNaN(average)){
            avrSpan.textContent = 0;
        } else {
            avrSpan.textContent = average.toFixed(2);
        }

        minInput.addEventListener('input', calculateAverage);
        maxInput.addEventListener('input', calculateAverage);
        
        function calculateAverage() {
            const min = parseFloat(minInput.value);
            const max = parseFloat(maxInput.value);
            
            const average = (min + max) / 2;

            if(isNaN(average)){
            avrSpan.textContent = 0;
            } else {
                avrSpan.textContent = average.toFixed(2);
            }

            avrSpan.textContent = average.toFixed(2);
        }
    </script>
</body>

</html>