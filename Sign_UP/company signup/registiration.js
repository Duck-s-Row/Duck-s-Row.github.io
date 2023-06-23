// // Change the Password into text
// function togglePasswordVisibility() {
// var passwordInput = document.getElementById("password");
// var passwordToggle = document.querySelector(".password-toggle svg path");

// if (passwordInput.type === "password") {
//     passwordInput.type = "text";
//     passwordToggle.setAttribute("d", "M12 3a9 9 0 0 1 2.97 17.3l1.43 1.44a1 1 0 0 1-1.42 1.42l-1.44-1.43A9 9 0 1 1 12 3zm0 2a7 7 0 0 0-.65 13.96l.65.04V5zm0 4a3 3 0 1 1 0 6 3 3 0 0 1 0-6zM9 9a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm6 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z");
// } else {
//     passwordInput.type = "password";
//     passwordToggle.setAttribute("d", "M12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z");
// }
// }

// const ShowRePassword = document.getElementById("#show-re-password");
// const rePassword = document.getElementById("#re-password");

// ShowRePassword.addEventListener("click", function() {

//     const type = rePassword.getAttribute("type") === "password" ? "text" : "password";
//     rePassword.setAttribute("type", type);

//     this.classList.toggle("bi-eye");
// });


const toggle = document.getElementById("#toggle-password");
var pass = document.getElementById("password");

function togglePassword() {
    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
  }

const toggleRe = document.getElementById("#toggle-re-password");
var pass2 = document.getElementById("re-password");

function toggleRePassword() {
    if (pass2.type === "password") {
        pass2.type = "text";
    } else {
        pass2.type = "password";
    }
  }

var msg = document.getElementById("message");
var str = document.getElementById("strength");

var msg2 = document.getElementById("passtwo");
var alertt= document.getElementById("alert");
var sub= document.getElementById("sub-btn");


pass.addEventListener('input',()=>{
    if(pass.value.length > 0){
        msg.style.display = "block";
    }
    else{
        msg.style.display = "none";
    }
    if(pass.value.length < 4){
        str.innerHTML = "weak";
        pass.style.borderColor = "red";
        msg.style.color = "red";
    }
    else if(pass.value.length > 4 && pass.value.length < 8){
        str.innerHTML = "medium";
        pass.style.borderColor = "yellow";
        msg.style.color = "yellow";
    }
    else if(pass.value.length > 8 && pass.value.length <= 16){
        str.innerHTML = "strong";
        pass.style.borderColor = "green";
        msg.style.color = "green";
    }
})

pass2.addEventListener('input',()=>{

    if(pass2.value.length > 0){
        msg2.style.display = "block";
    }
    else
    {
        msg2.style.display = "none"; 
    }
    if(pass2.value == pass.value ){
        alertt.innerHTML = "the same";
        alertt.style.borderColor = "green"
        msg2.style.color = "green";
        sub.disabled = false;
    }
    else{
        alertt.innerHTML = "not the same";
        alertt.style.borderColor = "red";
        msg2.style.color = "red";
        sub.disabled = true;
    }
})