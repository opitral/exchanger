<?php
    require_once("connect.php");

    $order_id = $_GET["id"];
    mysqli_query($connect, "UPDATE orders SET status='timeout' WHERE id='$order_id'");

    header("Location: ../404.php");