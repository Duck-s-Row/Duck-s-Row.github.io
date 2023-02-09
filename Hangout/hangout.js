// let budget = document.getElementById("budget-range").value;

var budget = document.getElementById("budget-range").value;
document.getElementById("demo").innerHTML = budget;

let button = document.getElementById("more");
let popup = document.querySelector(".popup");
let exit = document.getElementById("exit");

button.addEventListener("click", () =>{
  popup.style.display = "flex";
})
exit.addEventListener("click", () =>{
  popup.style.display = "none";
})