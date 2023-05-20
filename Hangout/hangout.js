let range = document.getElementById("rangeVlaue");
function rangeChange(value) {
  range.innerHTML = value;
}
//Filter
var selectLocation = document.getElementById("p_branch");
var selectSort = document.getElementById("sort");
var container = document.querySelector(".f_row");
var checkboxes = document.querySelectorAll('input[name="category[]"]');
selectLocation.addEventListener("change", filter);
selectSort.addEventListener("change", filter);
for(var checkbox of checkboxes){
  checkbox.addEventListener("change",filter);
}

function filter() {
  var location = selectLocation.value;
  var sort = selectSort.value;
  var selectdCategories = Array.from(document.querySelectorAll('input[name="category[]"]:checked')).map(function(checkbox){
    return checkbox.value
  });

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
              <div class="dis">
                <p>${item.category}<br>
                ${item.small_details}</p>
              </div>
              <h6>Average: </h6>
                ${item.average_budget}
            </div>
            <div class="location-text">
              <i class="fa-solid fa-location-dot"></i>
              <p>${item.p_branch}</p>
            </div>
              <div class="more">
              <form method="post">
              <input type="hidden" name="place_id" value="${item.place_id}">
                <input type="submit" name="more" id="more" value="More">
              </form>
            </div>
          </div>
        `;
      }
      container.innerHTML = out;
    }
  }; 

  xhr.open('POST', 'script.php');
  xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
  xhr.send("location=" + encodeURIComponent(location) + "&sort=" + encodeURIComponent(sort) + "&categories=" + encodeURIComponent(JSON.stringify(selectdCategories)));
}
