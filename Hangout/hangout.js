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
//Location with Sort Filter
var selectLocation = document.getElementById("p_branch");
var selectSort = document.getElementById("sort");
var container = document.querySelector(".f_row");

selectLocation.addEventListener("change", filter);
selectSort.addEventListener("change", filter);

function filter() {
  var location = selectLocation.value;
  var sort = selectSort.value;

  var xhr = new XMLHttpRequest();
  xhr.onload = function() {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      var out = "";
      for (var item of response) {
        out += `
          <div class="card">
            <img src="logos/${item.logo}" alt="Logo Picture">
            <div class="text1">
              <h1>${item.p_name}</h1>
              <p>${item.details}</p>
              <h6>Average: </h6>
              ${item.average_budget}
            </div>
            <hr>
            <div class="location-text">
              <i class="fa-solid fa-location-dot"></i>
              <p>${item.p_branch}</p>
            </div>
            <button class="location" id="more">More</button>
          </div>
        `;
      }
      container.innerHTML = out;
    }
  };
  xhr.open('POST', 'script.php');
  xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
  xhr.send("location=" + location + "&sort=" + sort);
}
