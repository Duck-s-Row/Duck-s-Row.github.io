<?php
include("../../connection/connection.php");
session_start();
$place_id =$_SESSION['place_id'];
$Data = "SELECT * FROM places WHERE place_id = $place_id LIMIT 1";
$result = mysqli_query($con,$Data);
if($result && mysqli_num_rows($result)>0){
 $row = mysqli_fetch_assoc($result);   
}
$pics_query = "SELECT * FROM place_pics WHERE place_id = $place_id";
$result_pics = mysqli_query($con,$pics_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="info.css">
    <title>info</title>
</head>
<body>

    <div class="photo">

        <div class="img">

        <a href="../hangout.php"><i class="fa-regular fa-circle-left back-arrow"></i></a>
        <h1><?php echo $row['p_name'] ?></h1>
        <?php while($row_pics = mysqli_fetch_assoc($result_pics)): ?>
            <img src="../places_imgs/<?php echo $row_pics['photo_name'] ?>" alt="<?php echo $row['p_name'] ?>">
        <?php endwhile; ?>
        </div>

        <div class="disc">

            <h2><?php echo $row['p_name']; ?></h2>
            <p><?php echo $row['details']; ?></p>

            <div class="box">

                <div class="box1">
                    <div>
                        <h3>Budget</h3>
                        <p><?php echo $row['min_price'] ?>-<?php echo $row['max_price'] ?> L.E/Person</p>
                    </div>
                    
                    <div>
                        <h3>Capisty</h3>
                        <p>1-50 Person</p>
                    </div>
    
                </div>

                    <div class="box2">
    
                        <div>
    
                            <h3>More Details</h3>
                                <ol>
                                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, fuga!</li>
                                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, fuga!</li>
                                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, fuga!</li>
                                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, fuga!</li>
                                </ol>
                        </div>
    
                    </div>

            </div>
        
        </div>
        
    </div>

    <footer class="btn">
        <button> Add to my plans </button>
    </footer>

</body>
</html>