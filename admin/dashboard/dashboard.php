<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/60b24d6b5a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="dashboards.css">
    <title>Dashboard</title>
</head>
<body>
    <header>
        <nav>
            <button onclick="pageRedirect()">My Site</button>
            <ul>
                <li class="li_dashboard active"><a href="#dashboard">dashboard</a></li>
                <li class="li_dashboard"><a href="#users">Users</a></li>
                <li class="li_dashboard"><a href="#places">places</a></li>
                <li class="li_dashboard"><a href="#requests">Requests</a></li>
            </ul>
        </nav>
    </header>
    <section class="dashboard" id="dashboard">
        <h3>Hi Admin, Welcome back</h3>
        <div class="shortcut">
            <div class="card">
                <h2>Users</h2>
                <i class="fa fa-user"></i>
                <a href="">Navigate</a>
            </div>
            <div class="card">
                <h2>Places</h2>
                <i class="fa fa-location-dot"></i>
                <a href="">Navigate</a>
            </div>
            <div class="card">
                <h2>Requests</h2>
                <i class="fa fa-phone"></i>
                <a href="">Navigate</a>
            </div>
        </div>
        <h2>Number of</h2>
        <div class="shortcut">
            <div class="card">
                <h2>Sign ups</h2>
                <div>
                    <i class="fa fa-user"></i>
                    <p>90</p>
                </div>
            </div>
            <div class="card">
                <h2>Places</h2>
                <div>
                    <i class="fa fa-user"></i>
                    <p>90</p>
                </div>
            </div>
            <div class="card">
                <h2>Requests</h2>
                <div>
                    <i class="fa fa-user"></i>
                    <p>90</p>
                </div>
            </div>
        </div>
    </section>

    <section class="users" id="users">
        <?php
             require("../../connection/connection.php");

            $sql = "SELECT * FROM users";
            $result = mysqli_query($con, $sql);

            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Delete</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["Fname"] . " " . $row["Lname"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td><a href='delete_user.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        ?>
    </section>

    <section class="places" id="places">
    <?php
             require("../../connection/connection.php");

            $sql = "SELECT * FROM places";
            $result = mysqli_query($con, $sql);

            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>bransh</th><th>category</th><th>Delete</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["p_name"] . "</td>";
                echo "<td>" . $row["p_branch"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td><a href='delete_user.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        ?>
    </section>

    <section class="request" id="request">request</section>

    <script>
        function pageRedirect() {
            window.location.href = "../../index.php";
        }

        let dashboard = document.getElementById("dashboard");
        let users = document.getElementById("users");
        let places = document.getElementById("places");
        let request = document.getElementById("request");
        let li_dashboard = document.querySelectorAll(".li_dashboard");

        li_dashboard[0].addEventListener("click", () =>{
            dashboard.style.display = "block";
            users.style.display = "none";
            places.style.display = "none";
            request.style.display = "none";

            li_dashboard[0].classList.add("active");
            li_dashboard[1].classList.remove("active");
            li_dashboard[2].classList.remove("active");
            li_dashboard[3].classList.remove("active");
        });

        li_dashboard[1].addEventListener("click", () =>{
            dashboard.style.display = "none";
            users.style.display = "block";
            places.style.display = "none";
            request.style.display = "none";

            li_dashboard[0].classList.remove("active");
            li_dashboard[1].classList.add("active");
            li_dashboard[2].classList.remove("active");
            li_dashboard[3].classList.remove("active");
        });

        li_dashboard[2].addEventListener("click", () =>{
            dashboard.style.display = "none";
            users.style.display = "none";
            places.style.display = "block";
            request.style.display = "none";

            li_dashboard[0].classList.remove("active");
            li_dashboard[1].classList.remove("active");
            li_dashboard[2].classList.add("active");
            li_dashboard[3].classList.remove("active");
        });

        li_dashboard[3].addEventListener("click", () =>{
            dashboard.style.display = "none";
            users.style.display = "none";
            places.style.display = "none";
            request.style.display = "block";

            li_dashboard[0].classList.remove("active");
            li_dashboard[1].classList.remove("active");
            li_dashboard[2].classList.remove("active");
            li_dashboard[3].classList.add("active");
        });
    </script>       
</body>
</html>