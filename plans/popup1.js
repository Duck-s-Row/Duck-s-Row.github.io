// var popup = document.getElementById("popup");
// var close = document.getElementById("close");
// var open = document.getElementById("open");

// close.addEventListener("click", ()=> {
//     console.log("close clicked");
//     popup.style.display = "none";
// });

// open.addEventListener("click", ()=> {
//     popup.style.display = "flex";
//     close.style.display = "block";
// });

function openPopup(planId) {
  var popup = document.getElementById("popup_" + planId);
  popup.style.display = "flex";
}

function closePopup(planId) {
  var popup = document.getElementById("popup_" + planId);
  popup.style.display = "none";
}

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