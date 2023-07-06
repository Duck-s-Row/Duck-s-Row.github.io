<?php
session_start();
require("../connection/connection.php");
require('../Functions/Functions.php');
if (isset($_SESSION['user_id'])) {
    $user_data = Get_user_data($con);
    if ($user_data['privilege'] != 1)
        header('Location:../index.php');
} else {
    //redirect to login page
    header("Location: ../Log_in/index.php");
    die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="d7.css">
    <link rel="website icon" type="png" href="../home/imgs/Logo.png">
    <title>Dashboard</title>
</head>

<body>

    <header>
        <button class="btn" onclick="window.history.back()">My Site</button>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li class="li_dashboard active"><a href="#dashboard">dashboard</a></li>
                <li class="li_dashboard" data-tab="users"><a href="#users">Users</a></li>
                <li class="li_dashboard" data-tab="places"><a href="#places">places</a></li>
                <li class="li_dashboard" data-tab="requests"><a href="#requests">Requests</a></li>
                <li class="li_dashboard" data-tab="insert"><a href="#insert">Insert Place</a></li>
            </ul>
        </nav>
    </header>

    <script>
        hamburger = document.querySelector(".hamburger");

        // Add the navigation bar active class
        hamburger.onclick = function() {
            navBar = document.querySelector(".nav-bar");
            navBar.classList.toggle("active");
        }
    </script>

    <section class="dashboard tap" id="dashboard">
        <h3>Hi Admin, Welcome back</h3>
        <div class="shortcut1">
            <div class="card">
                <h2>Users</h2>
                <i class="fa fa-user"></i>
                <a href="#users" class="navigate">Navigate</a>
            </div>
            <div class="card">
                <h2>Places</h2>
                <i class="fa fa-location-dot"></i>
                <a href="#places" class="navigate">Navigate</a>
            </div>
            <div class="card">
                <h2>Requests</h2>
                <i class="fa fa-envelope"></i>
                <a href="#requests" class="navigate">Navigate</a>
            </div>
        </div>
        <h2 class="number-of">Number of</h2>
        <div class="shortcut2">
            <div class="card" id="numcard">
                <h2>Sign ups</h2>
                <div>
                    <i class="fa fa-user"></i>
                    <p>
                        <?php

                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($con, $sql);
                        $count_user = 0;

                        while ($row = mysqli_fetch_assoc($result)) {
                            $count_user++;
                        }
                        echo $count_user;
                        ?>
                    </p>
                </div>
            </div>
            <div class="card" id="numcard">
                <h2>Places</h2>
                <div>
                    <i class="fa fa-location-dot"></i>
                    <p>
                        <?php

                        $sql = "SELECT * FROM places";
                        $result = mysqli_query($con, $sql);
                        $count_places = 0;

                        while ($row = mysqli_fetch_assoc($result)) {
                            $count_places++;
                        }
                        echo $count_places;
                        ?>
                    </p>
                </div>
            </div>
            <div class="card" id="numcard">
                <h2>Requests</h2>
                <div>
                    <i class="fa fa-envelope"></i>
                    <p>
                        <?php

                        $sql = "SELECT * FROM requests";
                        $result = mysqli_query($con, $sql);
                        $count_requests = 0;

                        while ($row = mysqli_fetch_assoc($result)) {
                            $count_requests++;
                        }
                        echo $count_requests;
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="users tap" id="users">
        <?php
        $sql = "SELECT * FROM users";
        $result = mysqli_query($con, $sql);

        echo "<table>";
        echo "<tr><th>ID</th><th>UserName</th><th>Full Name</th><th>Email</th><th>Privilege</th><th>Action</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["Fname"] . " " . $row["Lname"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";

            echo "<td>
                    <form method='POST' action='update_user.php'>
                        <input type='hidden' name='id' value='" . $row["user_id"] . "'>
                        <input type='text' name='privilege' value='" . $row["privilege"] . "'>
                        <input type='submit' value='Update'>
                    </form>
                </td>";
            echo "<td><a href='delete_user.php?id=" . $row["user_id"] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </section>

    <section class="places tap" id="places">
        <?php

        $sql = "SELECT * FROM places";
        $result = mysqli_query($con, $sql);

        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>bransh</th><th>category</th><th>Delete</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["place_id"] . "</td>";
            echo "<td>" . $row["p_name"] . "</td>";
            echo "<td>" . $row["p_branch"] . "</td>";
            echo "<td>" . $row["category"] . "</td>";
            echo "<td><a href='delete_place.php?id=" . $row["place_id"] . "' onclick='return confirm(\"Are you sure you want to delete this Place?\")'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </section>

    <section class="request tap" id="request">
        <table>
            <tr>
                <th>Request Id</th>
                <th>User Name</th>
                <th>Place Name</th>
                <th>Category</th>
                <th>Status</th>
                <th></th>
            </tr>

            <?php
            $selectAllReq = "SELECT requests.request_id,username,p_name,category,req_status FROM users,requests,request_details WHERE users.user_id = requests.user_id AND requests.request_id = request_details.request_id";
            $allReq = mysqli_query($con, $selectAllReq);
            while ($eachReq = mysqli_fetch_assoc($allReq)) :
            ?>
                <tr>
                    <td><?php echo $eachReq['request_id'] ?></td>
                    <td><?php echo $eachReq['username'] ?></td>
                    <td><?php echo $eachReq['p_name'] ?></td>
                    <td><?php echo $eachReq['category'] ?></td>
                    <td><?php echo $eachReq['req_status'] ?></td>
                    <td>
                        <form action="more.php" method="post">
                            <input type="hidden" name="req_id" value="<?php echo $eachReq['request_id'] ?>">
                            <input type="submit" value="More">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>


    <section class="insert tap" id="insert">
        <?php
        $select_places = "select * from places";
        $result = mysqli_query($con, $select_places);
        ?>
        <form method="post" align='center' class="place" action="insertData.php">
            <div class="c1">
                <input type="hidden" name="Form_identifier" value="insert_new_place">
                <label for="p_name">Place Name:</label>
                <input type="text" name="p_name" id="p_name"><br>
                <label for="p_branch">Place Branch:</label>
                <select id="p_branch" name="p_branch">
                    <optgroup label="GIZA">
                        <option value="haram">Haram</option>
                        <option value="fisal">Fisal</option>
                        <option value="el doki">El Doki</option>
                        <option value="zamalek">Zamalek</option>
                        <option value="6th october">6th October</option>
                        <option value="el shiekh zayed">El shiekh zayed</option>
                        <option value="el mohandseen">El Mohandseen</option>
                        <option value="el manial">El Manial</option>
                    </optgroup>
                </select><br>
                <label for="small_details">Small details:</label>
                <input type="text" name="small_details" id="small_details"><br>
                <label for="more_details">More details:</label>
                <input type="text" name="more_details" id="more_details"><br>
                <label for="category">Category:</label>
                <select name="category" id="">
                    <option value="Cafe">Cafe</option>
                    <option value="Restaurants">Restaurants</option>
                    <option value="Park">Park</option>
                    <option value="Museums">Museums</option>
                    <option value="Mall">Mall</option>
                    <option value="Cinema">Cinema</option>
                    <option value="EscapeRoom">Escape Rooms</option>
                </select><br>
                <label for="location">Location:</label>
                <input type="url" name="location" id="location"><br>
                <div class="min-max">
                    <label for="min">Min:</label>
                    <input type="number" name="min" id="min">
                    <label for="max">Max:</label>
                    <input type="number" name="max" id="mx"><br>
                    <label for="uper_location">UPER Location</label>
                    <input type="url" name="uper_location" id="uper_location">
                </div>
                <input type="submit" value="save">
            </div>
            <hr>
        </form>

        <div class="c2">
            <form method="post" align=center enctype="multipart/form-data" class="photo" action="insertData.php">
                <input type="hidden" name="Form_identifier" value="insert_photo">
                <label for="p_name">choose a place:</label>
                <select id="p_name" name="place_id">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) : ?>
                        <option value="<?php echo $row['place_id'] ?>"><?php echo $row['p_name'] . " " . $row['p_branch'] ?></option>
                    <?php endwhile; ?>
                </select><br>
                <label for="photo_name">insert photo</label>
                <input type="file" name="photo_name" id="photo_name" accept=".jpg, .png, .jpeg"><br>
                <input type="submit" value="save">
            </form><br><br>


            <form method="post" enctype="multipart/form-data" align=center class="logo" action="insertData.php">
                <label for="p_name">choose a place:</label>
                <select id="p_name" name="p_name">
                    <?php
                    $select_places1 = "SELECT DISTINCT p_name FROM places";
                    $result1 = mysqli_query($con, $select_places1);
                    while ($row1 = mysqli_fetch_assoc($result1)) : ?>
                        <option value="<?php echo $row1['p_name'] ?>"><?php echo $row1['p_name'] ?></option>
                    <?php endwhile; ?>
                </select><br>
                <input type="hidden" name="Form_identifier" value="insert_logo">
                <label for="logo_name">insert logo</label>
                <input type="file" name="logo_name" id="logo_name" accept=".jpg, .png, .jpeg"><br>
                <input type="submit" value="save">
            </form><br><br>

            <form method="post" enctype="multipart/form-data" align=center class="offers" action="insertData.php">
                <input type="hidden" name="Form_identifier" value="insert_offer">
                <label for="offer">Insert offer picture</label>
                <input type="file" name="offer" id="offer" accept=".jpg, .png, .jpeg"><br>
                <input type="submit" value="save">
            </form><br><br>
            <form method="POST" align='center' enctype="multipart/form-data" class="menu" action="insertData.php">
                <input type="hidden" name="Form_identifier" value="Insert_menu">
                <label for="place_name_menu">choose place</label>
                <select name="place_name_menu" id="place_name_menu">
                    <?php
                    $selectALLPlacesN = "SELECT distinct p_name FROM places WHERE category = 'Restaurants' OR category = 'Cafe' OR category = 'Cinema'";
                    $placesNames = mysqli_query($con, $selectALLPlacesN);
                    while ($eachPlaceName = mysqli_fetch_array($placesNames)) :
                    ?>
                        <option value="<?php echo $eachPlaceName['p_name'] ?>"><?php echo $eachPlaceName['p_name'] ?></option>
                    <?php endwhile; ?>
                </select><br>
                <label for="menu_image">Insert Menu Image</label>
                <input type="file" name="menu_image" id="menu_image" accept=".jpg, .png, .jpeg"><br>
                <input type="submit" value="Save">
            </form>
        </div>
    </section>

    <script src="dash.js"></script>
</body>

</html>