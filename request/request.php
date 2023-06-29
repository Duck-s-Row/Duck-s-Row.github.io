<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="requestsss.css">
    <title>Document</title>
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
    <form action="send_data.php" method="post">
        <section class="main">
            <div class="photo">
                <h2>Logo of the Place</h2>
                <input type="file" name="images">
                <h2>Photos of the Place</h2>
                <input type="file" name="images" multiple>
                <h2>Menu of the Place (optional)</h2>
                <input type="file" name="images" multiple>
            </div>
            <div class="disc">
                <div>
                    <h2>Place Name</h2>
                    <input type="text" name="p_name" placeholder="Enter place name">
                    <h2>Category</h2>
                    <select name="category" id="category">
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
                            <p><input type="number" name="min" placeholder="min price"> - <input type="number" name="max" placeholder="max price"> L.E/Person</p>
                            <h2>Average</h2>
                            <p>200 L.E / Person</p>
                        </div>
                    </div>
                    <div class="box2">
                        <div>
                            <h2>Details</h2>
                            <textarea name="details" placeholder="Enter more details"></textarea>
                        </div>
                    </div>
                </div>
                <div class="map-container">
                    <h2>Place Branch</h2>
                    <select id="p_branch" name="p_branch">
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
                    <h2>Location : </h2>
                    <input type="text" name="location" placeholder="Enter location URL">
                </div>
                <input type="submit" value="Request" class="submit_request">
            </div>
        </section>
    </form>
</body>
</html>