let date = document.getElementById("date");
let chooice = document.querySelectorAll(".chooice");
let details_info = document.getElementById("details_info");
let edit_info = document.getElementById("edit_info");
let favorites = document.getElementById("favorites");
let planes = document.getElementById("planes");
let det = document.getElementById("det");

date.defaultValue = "2023-02-23";

chooice.forEach(button => {
    button.addEventListener("click", () => {
        resetlinks();
        button.classList.add("active");
    });
})

function resetlinks() {
    chooice.forEach(button => {
        button.classList.remove("active");
    })
}

chooice[0].addEventListener("click", () => {
    details_info.style.display = 'block';
    planes.style.display = 'none';
    edit_info.style.display = 'none';
    favorites.style.display = 'none';
});

chooice[1].addEventListener("click", () => {
    details_info.style.display = 'none';
    planes.style.display = 'block';
    edit_info.style.display = 'none';
    favorites.style.display = 'none';
});


chooice[2].addEventListener("click", () => {
    details_info.style.display = 'none';
    planes.style.display = 'none';
    edit_info.style.display = 'block';
    favorites.style.display = 'none';
});

chooice[3].addEventListener("click", () => {
    details_info.style.display = 'none';
    planes.style.display = 'none';
    edit_info.style.display = 'none';
    favorites.style.display = 'block';
});