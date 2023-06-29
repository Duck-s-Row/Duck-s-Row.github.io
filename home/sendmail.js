function sendMail(){
    var xhr = new XMLHttpRequest();

    var Name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var message = document.getElementById("message").value;
    
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200 ){
            document.getElementById("checking_form").innerHTML = xhr.responseText;
        }
    }
    
    xhr.open("POST","home/emailHandler.php",true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    // xhr.send("name="+Name+"&email="+email+"&message="+message);
    xhr.send("name=" + encodeURIComponent(Name) + "&email=" + encodeURIComponent(email) + "&message=" + encodeURIComponent(message));
}