<?php if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $req_id = $_POST['re_id'];
                $_SESSION['request_id'] = $req_id;
                header("Location:more/moreInfo.php");
        }
