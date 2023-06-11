var popup = document.getElementById("popup");
var close = document.getElementById("close");
var open = document.getElementById("open");

close.addEventListener("click", ()=> {
    popup.style.display = "none";
});

open.addEventListener("click", ()=> {
    popup.style.display = "flex";
    close.style.display = "block";
});

var addpopform = document.getElementById("addpopform");
var plan_form_btn = document.getElementById("plan_form_btn");

plan_form_btn.addEventListener("click", ()=> {
    addpopform.style.display = "flex";
    plan_form_btn.style.display = "none";
})