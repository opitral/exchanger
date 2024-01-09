<?php
    $host = "45.84.206.203";
    $user = "u599936829_root";
    $pass = "Nz^EdXj81Uk2";
    $db = "u599936829_exchenger";

    $connect = mysqli_connect($host, $user, $pass, $db);

    if (!$connect) {
        die("Could not connect");
    }
?>