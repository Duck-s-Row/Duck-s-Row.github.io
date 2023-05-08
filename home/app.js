var loader = document.getElementById("loader");

window.addEventListener("load", function loading(){
    setTimeout(function() {
        loader.style.display = "none";
    }, 2000);
});

hamburger = document.querySelector(".hamburger");
home = document.getElementById("home");
contact_us = document.getElementById("contact_us");
about_us = document.getElementById("about_us");
services = document.getElementById("services");

navBar = document.querySelector(".nav-bar");

let subMenu = document.getElementById("subMenu");

// Add the open menu class
function toggleMenu() {
 subMenu.classList.toggle("open-menu");
}
// Add the navigation bar active class
hamburger.onclick = function() {
 navBar.classList.toggle("active");
}

// Remove the navigation bar active class and the open menu class
home.onclick = function() {
 navBar.classList.remove("active");
 subMenu.classList.remove("open-menu");
}
about_us.onclick = function() {
 navBar.classList.remove("active");
 subMenu.classList.remove("open-menu");
}
contact_us.onclick = function() {
 navBar.classList.remove("active");
 subMenu.classList.remove("open-menu");
}
services.onclick = function() {
 navBar.classList.remove("active");
 subMenu.classList.remove("open-menu");
}
