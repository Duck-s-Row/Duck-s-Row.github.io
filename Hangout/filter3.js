//Filter
var selectLocation = document.getElementById("p_branch");
var selectSort = document.getElementById("sort");
var selectbudget = document.getElementById("budget");
var container = document.querySelector(".choices");
var checkboxes = document.querySelectorAll('input[name="category[]"]');

selectbudget.addEventListener("change", filter);
selectLocation.addEventListener("change", filter);
selectSort.addEventListener("change", filter);
for (var checkbox of checkboxes) {
  checkbox.addEventListener("change", filter);
}

function filter() {
  var location = selectLocation.value;
  var sort = selectSort.value;
  var budget = selectbudget.value;
  var selectdCategories = Array.from(document.querySelectorAll('input[name="category[]"]:checked')).map(function(checkbox) {
    return checkbox.value
  });

  var xhr = new XMLHttpRequest();
  xhr.onload = function() {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      var out = "";
      for (var i = 0; i < response.length; i += 2) {
        var item1 = response[i];
        var item2 = (i + 1 < response.length) ? response[i + 1] : null;

        out += `
          <div class="f_row">
            <div class="card">
              <div class="card2">
                <img src="logos/${item1.logo}" alt="Logo Picture">
                <div class="text1">
                  <h1><b>${item1.p_name}</b></h1>
                  <div class="dis">
                    <p>${item1.category}</p>
                  </div>
                  <h6>Average:<br>${item1.average_budget}</h6>
                  <div class="location-text">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>${item1.p_branch}</p>
                  </div>
                </div>
                <div class="text2">
                  <!-- <div class="more"> -->
                    <form method="POST" id="hidden_form_${item1.place_id}" style="display: none;" >
                      <input type="hidden" name="Form_identifier" value="more">
                      <input type="hidden" name="place_id" value="${item1.place_id}">
                      <input type="submit" name="more" id="more" value="More">
                    </form>
                  <!-- </div> -->
                  <div class="icons">
                    <a href="" onclick="event.preventDefault(); document.getElementById('hidden_form_${item1.place_id}').submit();"><i class="fa-solid fa-eye"></i></a>
                    
                  </div>
                </div>
              </div>
            </div>
            
            ${item2 ? `
            <div class="card">
              <div class="card2">
                <img src="logos/${item2.logo}" alt="Logo Picture">
                <div class="text1">
                  <h1><b>${item2.p_name}</b></h1>
                  <div class="dis">
                    <p>${item2.category}</p>
                  </div>
                  <h6>Average:<br>${item2.average_budget}</h6>
                  <div class="location-text">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>${item2.p_branch}</p>
                  </div>
                </div>
                <div class="text2">
                  <!-- <div class="more"> -->
                    <form method="POST" id="hidden_form_${item2.place_id}" style="display: none;" >
                      <input type="hidden" name="Form_identifier" value="more">
                      <input type="hidden" name="place_id" value="${item2.place_id}">
                      <input type="submit" name="more" id="more" value="More">
                    </form>
                  <!-- </div> -->
                  <div class="icons">
                    <a href="" onclick="event.preventDefault(); document.getElementById('hidden_form_${item2.place_id}').submit();"><i class="fa-solid fa-eye"></i></a>
                    
                  </div>
                </div>
              </div>
            </div>
            ` : ''}
          </div>
        `;
      }

      container.innerHTML = out;
    }
  };

  xhr.open('POST', 'filters.php');
  xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
  xhr.send("location=" + encodeURIComponent(location) + "&sort=" + encodeURIComponent(sort) + "&budget=" + encodeURIComponent(budget) + "&categories=" + encodeURIComponent(JSON.stringify(selectdCategories)));
}