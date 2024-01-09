<?php
    session_start();
    $page = $_GET["page"];
    $id = $_GET["id"];

    $_SESSION["lang"] = ($_SESSION["lang"] == "en") ? "ru" : "en";

    if ($page == "order") header("Location: ../order.php?id=$id");
    elseif ($page == "index") header("Location: ../index.php");
    elseif ($page == "rules") header("Location: ../rules.php");
    else header("Location: ../404.php");
?>