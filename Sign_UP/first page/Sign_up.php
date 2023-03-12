<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="signup.css">
    <link rel="website icon" type="png" href="../../home/imgs/Logo.png">
    <title>SIGN UP</title>
</head>
<body>
    <header>
        <div class="head">
            <h1>SIGN UP</h1>
            <span align="center">Already registered?<a href="../../Log_in/login.php">Login</a></span>
        </div>
    </header>

    <section class="forms">
        <form>
            <button id="face-btn">Sign up with Facebook <i class="fab fa-facebook"></i></button><br>
            <button id="google-btn">Sign up with Google<i class="fab fa-google"></i></button><br>
        </form>
        <button onclick="pageRedirect()" id="new-acc">Create New Account</button>
        <img src="images/pngfind.com-duckling-png-5872453(Y).png" width="90" height="55"/>
    </section>

    <script>
        let new_acc = document.getElementById("new-acc");
        // document.getElementById("new-acc").addEventListener("click", );
        function pageRedirect() {
            window.location.href = "../ThirdPage/regist.php";
        }
    </script>
</body>
</html>