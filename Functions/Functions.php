<?php

function check_login($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query ="select * from users where user_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result)>0)
        {
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
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query ="select * from users where user_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result)>0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
}


function random_num($length)
{
    $text = "";
    if($length<5)
    {
        $length=5;
    }
    $len = rand(4,$length);
    for($i=0;$i<$len;$i++)
    {
        $text .= rand(0,9);
    }
    return $text;
}

function check_privilege_hangout($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query ="select * from users where user_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result)>0)
        {
            $user_data = mysqli_fetch_assoc($result);
            if($user_data['privilege']==0)
                header('Location:../../index.php');
        }
    }
    //redirect to login page
    else
    {
        header("location: ../../Log_in/login.php");
        die;
    }
}