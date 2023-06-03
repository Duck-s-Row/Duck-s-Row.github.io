var popup = document.getElementById("popup");
var close = document.getElementById("close");
var open = document.getElementById("open");

close.addEventListener("click", ()=> {
    console.log("close clicked");
    popup.style.display = "none";
});

open.addEventListener("click", ()=> {
    popup.style.display = "flex";
    close.style.display = "block";
});