<?php
    require_once "connect.php";


    $order_id = $_GET["id"];
    mysqli_query($connect, "UPDATE orders SET status='pay' WHERE id='$order_id'");

    header("Location: ../order.php?id=$order_id");