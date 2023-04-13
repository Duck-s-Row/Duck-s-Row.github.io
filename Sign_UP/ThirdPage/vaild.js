
var pass = document.getElementById("password");
var msg = document.getElementById("message");
var str = document.getElementById("strength");

var pass2 = document.getElementById("re-password");
var msg2 = document.getElementById("passtwo");
var alertt= document.getElementById("alert");

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
    }
    else{
        alertt.innerHTML = "not the same";
        alertt.style.borderColor = "red";
        msg2.style.color = "red";
    }



})