//Filter
var selectLocation = document.getElementById("p_branch");
var selectSort = document.getElementById("sort");
var selectbudget = document.getElementById("budget");
var container = document.querySelector(".f_row");
var checkboxes = document.querySelectorAll('input[name="category[]"]');

selectbudget.addEventListener("change",filter);
selectLocation.addEventListener("change", filter);
selectSort.addEventListener("change", filter);
for(var checkbox of checkboxes){
  checkbox.addEventListener("change",filter);
}

function filter() {
  var location = selectLocation.value;
  var sort = selectSort.value;
  var budget = selectbudget.value;
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
                <div class="card2">
                    <img src="logos/${item.logo}" alt="Logo Picture">
                    <div class="text1">
                        <h1><b>${item.p_name}</b></h1>
                        <div class="dis">
                            <p>
                            ${item.category}
                            </p>
                        </div>
                        <h6>Average: <br>${item.average_budget}</h6>
                        <div class="location-text">
                            <i class="fa-solid fa-location-dot"></i>
                            <p>${item.p_branch}</p>
                        </div>
                    </div>
                    <div class="more">
                        <form method="POST">
                            <input type="hidden" name="place_id" value="${item.place_id}">
                            <input type="submit" name="more" id="more" value="More">
                        </form>
                    </div>
                </div>
            </div>

        `;
      }
      container.innerHTML = out;
    }
  }; 

  xhr.open('POST', 'filters.php');
  xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
  xhr.send("location=" + encodeURIComponent(location) + "&sort=" + encodeURIComponent(sort)+"&budget=" + encodeURIComponent(budget) + "&categories=" + encodeURIComponent(JSON.stringify(selectdCategories)));
}