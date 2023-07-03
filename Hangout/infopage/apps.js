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

// Menu Popup page
var popup_menu = document.getElementById("menu_popup");
var close_menu = document.getElementById("close_menu");
var open_menu = document.getElementById("open_menu");

close_menu.addEventListener("click", ()=> {
    popup_menu.style.display = "none";
});

open_menu.addEventListener("click", ()=> {
    popup_menu.style.display = "flex";
    close_menu.style.display = "block";
});