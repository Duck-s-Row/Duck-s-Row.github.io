<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Duck's Row</title>
    <link rel="stylesheet" href="forget5.css">
    <link rel="website icon" type="png" href="../home/imgs/Logo.png">
</head>
<body>
    <header>
        <div class="head">
            <h1>FORGET PASSWORD</h1>
            <span>Enter New Password</span>
        </div>
    </header>
    <section class="forget-password">
        <div class="content">
            <div class="newpass">
                <input type="password" placeholder="New password" /><br>
                <input type="password" placeholder="Confirm new password"/>
            </div>
            <button onclick="pageRedirect()">Confirm</button>
        </div>
    </section>
    <footer class="logo">
        <img src="../images/pngfind.com-duckling-png-5872453(Y).png" width="90" height="55"/>
    </footer>
    <script>
        function pageRedirect() {
            window.location.href = "../../Log_in/login.php";
        }
    </script>
</body>
</html>