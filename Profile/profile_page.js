
let chooice = document.querySelectorAll(".chooice");
let details_info = document.getElementById("details_info");
let pass = document.getElementById("pass");
let planes = document.getElementById("planes");
let det = document.getElementById("det");

chooice.forEach(button => {
    button.addEventListener("click", () => {
        resetlinks();
        button.classList.add("active");
    });
})

function resetlinks() {
    chooice.forEach(button => {
        button.classList.remove("active");
    })
}

chooice[0].addEventListener("click", () => {
    details_info.style.display = 'block';
    planes.style.display = 'none';
    pass.style.display = 'none';
});

chooice[1].addEventListener("click", () => {
    window.location.href = '../plans/plans.php';
});


chooice[2].addEventListener("click", () => {
    details_info.style.display = 'none';
    planes.style.display = 'none';
    pass.style.display = 'block';
});

var new_pass = document.getElementById("new_pass");
var pass2 = document.getElementById("renew_pass");
var msg2 = document.getElementById("passtwo");
var alertt= document.getElementById("alert");
var sub= document.getElementById("sub-btn");

pass2.addEventListener('input',()=>{

if(pass2.value.length > 0){
    msg2.style.display = "block";
}
else
{
    msg2.style.display = "none"; 
}
if(pass2.value == new_pass.value ){
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

