﻿<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Duck's Row</title>
    <link rel="stylesheet" href="forget.css">
    <link rel="website icon" type="png" href="../home/imgs/Logo.png">
</head>
<body>
    <header>
        <div class="head">
            <h1>FORGET PASSWORD</h1>
            <span>New Password</span>
        </div>
    </header>
    <section class="forget-password">
        <div class="content">
            <p>E-mail</p>
            <div class="email">
                <input type="email" placeholder="E-mail" />
            </div>
            <button onclick="pageRedirect()">Send</button>
        </div>
    </section>
    <footer class="logo">
        <img src="../images/pngfind.com-duckling-png-5872453(Y).png" width="90" height="55"/>
    </footer>

    <script>
        function pageRedirect() {
            window.location.href = "../page 2/forget2.php";
        }  
    </script>
</body>
</html>