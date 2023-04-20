<?php
session_start();
include("../connection/connection.php");
include("../Functions/Functions.php");
$user_data=check_login($con);
$user_id = $user_data['user_id'];
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $gender = $_POST['gender'];
    $update_query = "update users set Fname=? ,Lname=? ,gender=? where user_id=$user_id";
    $stmt = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($stmt, "sss", $fname, $lname, $gender);
    mysqli_stmt_execute($stmt);
    header('Location:profile.php');
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
    <link rel="stylesheet" href="profilee.css">
    <title>Profile</title>
</head>
<body>
    <section class="main">
        <div class="user_choices">
            <div class="user">
                <a href="../index.php" id="home"><i class="fa fa-arrow-circle-left"></i><span>&nbsp;Home <i class="fa fa-ducks"></i></span></a>
                <img src="" alt="profile_picture">
                <h2><?php echo $user_data['username'] ?></h2>
                <h3><?php echo $user_data['email'] ?></h3>
            </div>
            <button class="chooice active" onclick="edit_info()"><a href="#"><i class="fa-regular fa-user"></i>&nbsp;Profile</a></button>
            <button class="chooice"><a href="#"><i class="fa-solid fa-location-dot"></i>&nbsp; My Plans</a></button>
            <!-- <button class="chooice" onclick="edit_info()"><a href="#"><i class="fa-solid fa-pen"></i>&nbsp;Edit profile</a></button> -->
            <button class="chooice"><a href="#"><i class="fa-solid fa-lock"></i>&nbsp;Change Password</a></button>
            <button class="chooice" onclick="window.location.href = '../Log_out/logout.php';" ><a href="#"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout</a></button>
        </div>

        <!-- start of profile details -->
        <div class="details_info" id="details_info">
            <div class="details"><h2><strong id="det">details</strong></h2></div>
            <form action="" method="post">
                <!-- first row -->
                <div class="c1">
                    <div class="c1f">
                        <label>First Name : </label><br>
                        <input id="firstName" class="firstName" type="text" value="<?php echo $user_data['Fname'] ?>"  name="firstName">
                    </div>

                    <div class="c1l">
                        <label class="llastName">Last Name : </label><br>
                        <input id="lastName" class="lastName" type="text" value="<?php echo $user_data['Lname'] ?>"  name="lastName">
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
                        <input id="phone" class="phone" type="tel" value="<?php echo $user_data['phone'] ?>"  name="phone" readonly>
                    </div>
                    
                    <?php if($user_data['gender']=="M"): ?>
                    <div class="gender">
                        <label>Gender : </label>
                        <div>
                            <label class="gmale">Male</label>
                            <input id="male" class="male" type="radio" checked="checked" value="M"  name="gender">
                        </div>
                        <div>
                            <label class="gfemale">Female</label>
                            <input id="female" class="female" type="radio" value="F"  name="gender">
                        </div> 
                    </div>
                    <?php else:?>
                    <div class="gender">
                        <label>Gender : </label>
                        <div>
                            <label class="gmale">Male</label>
                            <input id="male" class="male" type="radio" value="M"   name="gender">
                        </div>
                        <div>
                            <label class="gfemale">Female</label>
                            <input id="female" class="female" type="radio" value="F" checked name="gender">
                        </div> 
                    </div>
                    <?php endif; ?>
                </div>
                <!-- end of third row -->

                <input type="submit" value="Update">
            </form>
        </div>
        <!-- end of profile details -->

        <!-- My Plans -->
        <div class="planes" id="planes">
            <div class="details"><h2><strong>My Plans</strong></h2></div>
                <div class="card">

                </div>
                <div class="card">

                </div>
                <div class="card2">
                    <a href="/Hangout/hangout.php"><h2>Add New Plan <span>+</span></h2></a>
                </div>
        </div>
        <!-- change password -->
        <div class="pass" id="pass">

        </div>
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
    <script src="app.js"></script>
    <!-- <script src="../js/all.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js.map"></script> -->
</body>
</html>