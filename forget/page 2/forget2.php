<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Duck's Row</title>
    <link rel="stylesheet" href="forget2.css">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="head">
            <h1>Forget Password</h1>
            <span>We'll send you a code to confirm this account</span>
        </div>
    </header>
    <section class="forget-password-ways">
        <div class="check-box">
            <button class="phone"><input type="radio" name="kind" ><label>Confirm via SMS<div class="font"><font >+20********</font></div></label></button><br>
            <button class="mail"><input type="radio" name="kind"><label>Confrim via E-mail<div class="font"><font >*******@gmail.com</font></div></label></button>
        </div>
        <div>
            <button class="cont" onclick="pageRedirect()">continue</button>
        </div>
    </section>
    <footer class="logo">
        <img src="../images/pngfind.com-duckling-png-5872453(Y).png" width="90" height="55"/>
    </footer>
    <script>
        function pageRedirect() {
            window.location.href = "../page 3/forget3.html";
        }  
    </script>
</body>
</html>