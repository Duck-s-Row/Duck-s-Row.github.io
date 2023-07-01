<?php
require("../connection/connection.php");
require('../Functions/Functions.php');
session_start();
if (isset($_SESSION['user_id'])) {
    $user_data = Get_user_data($con);
    $user_id = $_SESSION['user_id'];
    if ($user_data['privilege'] != 1 && $user_data['privilege'] != 2) {
        header('Location:../index.php');
    }
} else {
    //redirect to login page
    header("Location: ../Log_in/login.php");
    die;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests</title>
    <link rel="website icon" type="png" href="../home/imgs/Logo.png">
</head>

<body>
    <p>DO You Want To Send New Request <a href="new request/index.php">Click here</a></p>
    <?php 
    $selectAllReq = "SELECT * FROM requests, request_details WHERE requests.user_id = $user_id AND request_details.request_id = requests.request_id";
    $allReq = mysqli_query($con,$selectAllReq);
    if(mysqli_num_rows($allReq)>0):
    ?>
    <table>
        <tr>
            <th>Place Name</th>
            <th>Category</th>
            <th>Branch</th>
            <th>Status</th>
            <th></th>
        </tr>
        <?php while($eachReq = mysqli_fetch_assoc($allReq)): ?>
        <tr>
            <td><?php echo $eachReq['p_name'] ?></td>
            <td><?php echo $eachReq['category'] ?></td>
            <td><?php echo $eachReq['p_branch'] ?></td>
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
    <?php endif; ?>
</body>

</html>