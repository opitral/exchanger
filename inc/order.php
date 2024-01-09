<?php
    require_once "connect.php";


    $order_id = mt_rand(100000, 999999);
    $send_coin = mysqli_real_escape_string($connect, $_POST["send_coin"]);
    $receive_coin = mysqli_real_escape_string($connect, $_POST["receive_coin"]);
    $send_value = mysqli_real_escape_string($connect, $_POST["send_value"]);
    $receive_value = mysqli_real_escape_string($connect, $_POST["receive_value"]);
    $address = mysqli_real_escape_string($connect, $_POST["address"]);
    $mail = mysqli_real_escape_string($connect, $_POST["mail"]);
    $referral = mysqli_real_escape_string($connect, $_COOKIE["ref"]);
    $timeout = strval(time() + 1800);

    mysqli_query($connect, "INSERT INTO orders (`id`, `send_coin`, `receive_coin`, `send_value`, `receive_value`, `address`, `mail`, `referral`, `timeout`) VALUES ($order_id, '$send_coin', '$receive_coin', '$send_value', '$receive_value', '$address', '$mail', '$referral', '$timeout')");
    
    header("Location: ../order.php?id=$order_id");