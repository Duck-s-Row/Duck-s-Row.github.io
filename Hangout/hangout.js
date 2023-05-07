let button = document.getElementById("more");
let popup = document.querySelector(".popup");
let exit = document.getElementById("exit");

button.addEventListener("click", () =>{
  popup.style.display = "flex";
})
exit.addEventListener("click", () =>{
  popup.style.display = "none";
})

let range = document.getElementById("rangeVlaue");
function rangeChange(value) {
  range.innerHTML = value;
}