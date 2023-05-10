<?php
session_start();
require("../connection/connection.php");
require("../Functions/Functions.php");
$user_data = check_login($con);
$user_id = $user_data['user_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['Form_identifier'] == "update_profile") {
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $gender = $_POST['gender'];
        $update_details_query = "update users set Fname=? ,Lname=? ,gender=? where user_id=$user_id";
        $stmt_details = mysqli_prepare($con, $update_details_query);
        mysqli_stmt_bind_param($stmt_details, "sss", $fname, $lname, $gender);
        mysqli_stmt_execute($stmt_details);
        header('Location:profile.php');
    } elseif ($_POST['Form_identifier'] == "update_password") {
        $new_password = $_POST['new_pass'];
        $hased_new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_password_query = "update users set password=? where user_id=$user_id";
        $stmt_new_password = mysqli_prepare($con, $update_password_query);
        mysqli_stmt_bind_param($stmt_new_password, "s", $hased_new_password);
        mysqli_stmt_execute($stmt_new_password);
        header('Location:profile.php');
    } elseif ($_POST['Form_identifier'] == "update_profile_pic") {
        $image_name = $_FILES['user_pic']['name'];
        $image_size = $_FILES['user_pic']['size'];
        $tmp_name = $_FILES['user_pic']['tmp_name'];

        //image validation 
        $valid_image_ext = ['jpg', 'png', 'jpeg'];
        $image_ext = explode('.', $image_name);
        $image_ext = strtolower(end($image_ext));
        if (!in_array($image_ext, $valid_image_ext)) {
            echo '
            <script>alert("Invalid Image Extension");</script>';
            header('Location:profile.php');
        } elseif ($image_size > 1200000) {
            echo '
            <script>alert("Imgae Size Is Too Large");</script>';
            header('Location:profile.php');
        } else {
            $new_image_name = random_num(10);
            $new_image_name .= "." . $image_ext;
            $update_profile_pic_query = "update users set user_pic = '$new_image_name' where user_id=$user_id";
            mysqli_query($con, $update_profile_pic_query);
            move_uploaded_file($tmp_name, 'user_profile_imgs/' . $new_image_name);
            header('Location:profilee.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css.map">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <link rel="website icon" type="png" href="../home/imgs/Logo.png">
    <link rel="stylesheet" href="profile.css">
    <title>Profile</title>
</head>

<body>
    <section class="main">
        <div class="user_choices">
            <div class="user">
                <a href="../index.php" id="home"><i class="fa fa-arrow-circle-left"></i><span>&nbsp;Home <i class="fa fa-ducks"></i></span></a>
                <img src="user_profile_imgs/<?php echo $user_data['user_pic'] ?>" alt="profile_picture">
                <div class="h">
                <h2><?php echo $user_data['username'] ?></h2>
                <h3><?php echo $user_data['email'] ?></h3>
                </div>
            </div>
            <div class="btns">
            <button class="chooice active" onclick="edit_info()"><a href="#"><i class="fa-regular fa-user"></i>&nbsp;Profile</a></button>
            <button class="chooice"><a href="#"><i class="fa-solid fa-location-dot"></i>&nbsp; My Plans</a></button>
            <!-- <button class="chooice" onclick="edit_info()"><a href="#"><i class="fa-solid fa-pen"></i>&nbsp;Edit profile</a></button> -->
            <button class="chooice"><a href="#"><i class="fa-solid fa-lock"></i>&nbsp;Change Password</a></button>
            <button class="chooice" onclick="window.location.href = '../Log_out/logout.php';"><a href="#"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout</a></button>
            </div>
        </div>

        <!-- start of profile details -->
        <div class="details_info" id="details_info">
            <div class="details">
                <h2><strong id="det">Details</strong></h2>
            </div>
            <form action="" method="post">
                <input type="hidden" name="Form_identifier" value="update_profile">
                <!-- first row -->
                <div class="c1">
                    <div class="c1f">
                        <label>First Name : </label><br>
                        <input id="firstName" class="firstName" type="text" value="<?php echo $user_data['Fname'] ?>" name="firstName">
                    </div>

                    <div class="c1l">
                        <label class="llastName">Last Name : </label><br>
                        <input id="lastName" class="lastName" type="text" value="<?php echo $user_data['Lname'] ?>" name="lastName">
                    </div>
                </div>
                <!-- end of the first row -->

                <!-- second row -->
                <div class="c2">
                    <label class="lemail">Your Email : </label><br>
                    <input class="email" type="email" value="<?php echo $user_data['email'] ?>" readonly>
                </div>
                <!-- end of second row -->

                <!-- third row -->
                <div class="c3">
                    <div class="c3f">
                        <label class="lphone">Phone Number: </label><br>
                        <input id="phone" class="phone" type="tel" value="<?php echo $user_data['phone'] ?>" name="phone" readonly>
                    </div>

                    <div class="gender">
                        <label>Gender : </label>
                        <div>
                            <label class="gmale">Male</label>
                            <input id="male" class="male" type="radio" value="M" name="gender">
                        </div>
                        <div>
                            <label class="gfemale">Female</label>
                            <input id="female" class="female" type="radio" value="F" name="gender">
                        </div>
                    </div>
                </div>
                <!-- end of third row -->

                <input type="submit" value="Update">
            </form>

            <!-- set profile pic -->
            <form enctype="multipart/form-data" method="post">
                <input type="hidden" name="Form_identifier" value="update_profile_pic">
                <label for="">Enter Your profile Picture</label>
                <input type="file" name="user_pic" id="" accept=".jpg, .png, .jpeg">
                <input type="submit" value="Save">
            </form>
            <!-- end of profile pic -->

        </div>
        <!-- end of profile details -->



        <!-- start of My Plans -->
        <div class="planes" id="planes">
            <div class="details">
                <h2><strong>My Plans</strong></h2>
            </div>
            <div class="card">

            </div>
            <div class="card">

            </div>
            <div class="card2">
                <a href="/Hangout/hangout.php">
                    <h2>Add New Plan <span>+</span></h2>
                </a>
            </div>
        </div>
        <!-- end of My Plans -->


        <!-- start of change password -->
        <div class="pass" id="pass">
            <div class="details">
                <h2><strong>Change Password</strong></h2>
            </div>
            <form action="" method="post">
                <input type="hidden" name="Form_identifier" value="check_password">
                <div class="old">
                    <label>Old Password : </label><br>
                    <input id="old_pass" class="old_pass" type="password" name="old_pass">
                </div>
                <input type="submit" value="check">
            </form>

            <form method="post">
                <input type="hidden" name="Form_identifier" value="update_password">
                <div class="new">
                    <div>
                        <label>New Password : </label><br>
                        <input id="new_pass" class="new_pass" type="password" name="new_pass" readonly>
                    </div>
                    <div class="rnew">
                        <label>R-Enter New Password : </label><br>
                        <input id="renew_pass" class="renew_pass" type="password" name="renew_pass" readonly>
                    </div>
                </div>
                <input type="submit" value="Save">
            </form>
            <div>
                <img src="/home/imgs/pyramids (1).png" alt="">
            </div>
        </div>
        <!-- end of change password -->


        <!-- Edit Profile -->
        <!-- <div class="edit_info" id="edit_info">
            <div class="details"><h2><strong>Edit details</strong></h2></div>
            <form action="" method="post">
                <label>First Name : </label>
                <input class="firstName" type="text" value="Kareem" name="firstName">
        
                <label class="llastName">Last Name : </label>
                <input class="lastName" type="text" value="Abdallah" name="lastName"><br>
                
                
                <label class="lphone">Mobile Phone :</label>
                <input class="phone" type="tel" value="01556892517" name="phone"><br>
                
                <div class="gender">
                    <label>Gender : </label>
                    <label class="gmale">Male</label>
                    <input class="male" type="radio" checked="checked" name="gender">
            
                    <label class="gfemale">Female</label>
                    <input class="female" type="radio" name="gender"><br>
                </div>
                <label class="lemail">Your Email : </label>
                <input class="email" type="email" value="ducksrow100@gmail.com"><br>
                <button type="submit">Save</button>
            </form>
        </div> -->
    </section>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['Form_identifier'] == "check_password") {
            $old_password = $_POST['old_pass'];
            $check_password_query = "select password from users where user_id = $user_id limit 1";
            $result_check = mysqli_query($con, $check_password_query);
            $old_password_DB = mysqli_fetch_assoc($result_check);
            if (password_verify($old_password, $old_password_DB['password'])) {
                echo '<script> document.getElementById("renew_pass").removeAttribute("readonly"); </script>';
                echo '<script> document.getElementById("new_pass").removeAttribute("readonly"); </script>';
                echo "<script> document.getElementById('old_pass').setAttribute('value', '$old_password') </script>";
            } else
                echo '<script>alert("Wrong Password\nPlease Re-Enter It")</script>';
        }
    }
    ?>
    <script src="app.js"></script>
    <script>
        <?php if ($user_data['gender'] == "M") : ?>
            let male = document.getElementById("male").setAttribute("checked", "checked");
        <?php else : ?>
            let female = document.getElementById("female").setAttribute("checked", "checked");
        <?php endif; ?>
    </script>
    <!-- <script src="../js/all.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js.map"></script> -->
</body>

</html>