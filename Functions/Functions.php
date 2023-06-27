<?php

function check_login($con)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    //redirect to login page
    header("location: ../Log_in/login.php");
    die;
}
function Get_user_data($con)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
}


function random_num($length)
{
    $text = "";
    if ($length < 5) {
        $length = 5;
    }
    $len = rand(4, $length);
    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }
    return $text;
}

function check_privilege_hangout($con)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            if ($user_data['privilege'] == 0)
                header('Location:../../index.php');
        }
    }
    //redirect to login page
    else {
        header("location: ../../Log_in/login.php");
        die;
    }
}

function getAllplaces($con)
{
    $selectAllplaces = "SELECT * FROM places ORDER BY Rand() ";
    $result = mysqli_query($con, $selectAllplaces);
    while ($row = mysqli_fetch_assoc($result)) {
        $places[] = $row;
    }
    return $places;
}

function filterLocationSort($con, $location, $sort, $categories,$budget)
{
    $sql = "SELECT * FROM places";
    $condition = [];
    if (!empty($location)) {
        $location = mysqli_real_escape_string($con, $location);
        $condition[] = "p_branch = '$location'";
    }

    if (!empty($budget)) {
        $location = mysqli_real_escape_string($con, $budget);
        $condition[] = "average_budget <= '$budget'";
    }

    if (!empty($categories)) {
        $categoryConditions = [];
        foreach ($categories as $category) {
            $category = mysqli_real_escape_string($con, $category);
            $categoryConditions[] = "category = '$category'";
        }
        $condition[] = "(" . implode(" OR ", $categoryConditions) . ")";
    }

    if (!empty($condition)) {
        $sql .= " WHERE " . implode(" AND ", $condition);
    }

    if ($sort == "top-Average") {
        $sql .= " ORDER BY average_budget DESC";
    } elseif ($sort == "low-Average") {
        $sql .= " ORDER BY average_budget ASC";
    } else{
        $sql .= " ORDER BY RAND()";
    }
    $result = mysqli_query($con, $sql);
    $filteredResults = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $filteredResults[] = $row;
    }
    return $filteredResults;
}