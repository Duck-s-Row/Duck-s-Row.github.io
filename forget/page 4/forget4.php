<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Duck's Row</title>
    <link rel="stylesheet" href="forget4.css">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="head">
            <h1>Forget Password</h1>
            <span>A code has been sent to your E-mail. Enter that code here</span>
        </div>
    </header>
    <section class="forget-password-ways">
        <h1 class="enter">Enter Code</h1>
        <div class="code">   
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1" class="space">
            <input type="text" maxlength="1" >
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
        </div>
        <a href="#" class="again">send code again?</a>
        <div>
            <button class="cont" onclick="pageRedirect()">continue</button>
        </div>
    </section>
    <footer class="logo">
        <img src="../images/pngfind.com-duckling-png-5872453(Y).png" width="90" height="55"/>
    </footer>
    <script>
        const inputs = document.querySelectorAll(".code input");
        inputs.forEach((input, index) => {
            input.dataset.index = index;
            input.addEventListener("paste", handleOtppaste);
            input.addEventListener("keyup", handleOtp);
        });
        function handleOtppaste(e){
            const data = e.clipboardData.getData("text");
            const value = data.split("");
            if(value.length === inputs.length){
                inputs.forEach((input, index) => (input.value = value[index]));
                submit();
            }
        }
        function handleOtp(e){
            const input = e.target;
            let value = input.value;
            input.value = "";
            input.value = value ? value[0] : "";
            let fieldIndex = input.dataset.index;
            if(value.length > 0 && fieldIndex < inputs.length - 1){
                input.nextElementSibling.focus();
            }
            if(e.key === "Backspace" && fieldIndex > 0){
                input.previousElementSibling.focus();
            }
            if(fieldIndex == inputs.length ){
                submit();
            }
        }
        function submit(){
            console.log("submitting....!");
            let otp = "";
            inputs.forEach((input) => {
                otp += input.value;
                input.disabled = true ;
                input.classList.add("disabled");
            });
            console.log(otp);
        }
        function pageRedirect() {
            window.location.href = "../page 5/forget5.php";
        }
    </script>
</body>
</html>