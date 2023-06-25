function pageRedirect() {
    window.location.href = "../../index.php";
}

let dashboard = document.getElementById("dashboard");
let users = document.getElementById("users");
let places = document.getElementById("places");
let request = document.getElementById("request");
let insert = document.getElementById("insert");
let li_dashboard = document.querySelectorAll(".li_dashboard");
let navigate = document.querySelectorAll(".navigate");

li_dashboard[0].addEventListener("click", () => {
    dashboard.style.display = "block";
    users.style.display = "none";
    places.style.display = "none";
    request.style.display = "none";
    insert.style.display = "none";

    li_dashboard[0].classList.add("active");
    li_dashboard[1].classList.remove("active");
    li_dashboard[2].classList.remove("active");
    li_dashboard[3].classList.remove("active");
    li_dashboard[4].classList.remove("active");
});

li_dashboard[1].addEventListener("click", () => {
    dashboard.style.display = "none";
    users.style.display = "block";
    places.style.display = "none";
    request.style.display = "none";
    insert.style.display = "none";

    li_dashboard[0].classList.remove("active");
    li_dashboard[1].classList.add("active");
    li_dashboard[2].classList.remove("active");
    li_dashboard[3].classList.remove("active");
    li_dashboard[4].classList.remove("active");
});

navigate[0].addEventListener("click", () => {
    dashboard.style.display = "none";
    users.style.display = "block";
    places.style.display = "none";
    request.style.display = "none";
    insert.style.display = "none";

    li_dashboard[0].classList.remove("active");
    li_dashboard[1].classList.add("active");
    li_dashboard[2].classList.remove("active");
    li_dashboard[3].classList.remove("active");
    li_dashboard[4].classList.remove("active");
});

li_dashboard[2].addEventListener("click", () => {
    dashboard.style.display = "none";
    users.style.display = "none";
    places.style.display = "block";
    request.style.display = "none";
    insert.style.display = "none";

    li_dashboard[0].classList.remove("active");
    li_dashboard[1].classList.remove("active");
    li_dashboard[2].classList.add("active");
    li_dashboard[3].classList.remove("active");
    li_dashboard[4].classList.remove("active");
});
navigate[1].addEventListener("click", () => {
    dashboard.style.display = "none";
    users.style.display = "none";
    places.style.display = "block";
    request.style.display = "none";
    insert.style.display = "none";

    li_dashboard[0].classList.remove("active");
    li_dashboard[1].classList.remove("active");
    li_dashboard[2].classList.add("active");
    li_dashboard[3].classList.remove("active");
    li_dashboard[4].classList.remove("active");
});

li_dashboard[3].addEventListener("click", () => {
    dashboard.style.display = "none";
    users.style.display = "none";
    places.style.display = "none";
    request.style.display = "block";
    insert.style.display = "none";

    li_dashboard[0].classList.remove("active");
    li_dashboard[1].classList.remove("active");
    li_dashboard[2].classList.remove("active");
    li_dashboard[3].classList.add("active");
    li_dashboard[4].classList.remove("active");
});
navigate[2].addEventListener("click", () => {
    dashboard.style.display = "none";
    users.style.display = "none";
    places.style.display = "none";
    request.style.display = "block";
    insert.style.display = "none";

    li_dashboard[0].classList.remove("active");
    li_dashboard[1].classList.remove("active");
    li_dashboard[2].classList.remove("active");
    li_dashboard[3].classList.add("active");
    li_dashboard[4].classList.remove("active");
});

li_dashboard[4].addEventListener("click", () => {
    dashboard.style.display = "none";
    users.style.display = "none";
    places.style.display = "none";
    request.style.display = "none";
    insert.style.display = "block";

    li_dashboard[0].classList.remove("active");
    li_dashboard[1].classList.remove("active");
    li_dashboard[2].classList.remove("active");
    li_dashboard[3].classList.remove("active");
    li_dashboard[4].classList.add("active");
});