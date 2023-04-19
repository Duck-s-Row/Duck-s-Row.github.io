
let chooice = document.querySelectorAll(".chooice");
let details_info = document.getElementById("details_info");
let pass = document.getElementById("pass");
let planes = document.getElementById("planes");
let det = document.getElementById("det");


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
    pass.style.display = 'none';
});

chooice[1].addEventListener("click", () => {
    details_info.style.display = 'none';
    planes.style.display = 'block';
    pass.style.display = 'none';
});


chooice[2].addEventListener("click", () => {
    details_info.style.display = 'none';
    planes.style.display = 'none';
    pass.style.display = 'block';
});