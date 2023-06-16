var planCardLinks = document.querySelectorAll('.plan-card-link');
planCardLinks.forEach(function(link){
    link.addEventListener('click',function(event){
        event.preventDefault();
        var planId = this.getAttribute('data-planid');
        var xhr = new XMLHttpRequest();
        xhr.open('POST','add_exist_plan.php',true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                // var response = xrh.responseText;
                var response = xhr.responseText;
                alert(response);
            }
        };
        xhr.send('pland_id= '+planId);
    });
});