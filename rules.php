<?php
    session_start();

    if ($_SESSION["lang"]) {
        require "inc/" . $_SESSION["lang"] . ".php";
    
    } else {
        $_SESSION["lang"] = "en";
        require require "inc/en.php";
    }
?>


<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"]; ?>">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $lang["title"];?></title>
  <link rel="shortcut icon" href="assets/img/logo_small.svg" type="image/svg+xml">
  <style>
    [class*="flex-"],[class*="jc-"],[class*="ai-"],[class*="gap-"]{display:flex}
  </style>
  <link rel="stylesheet" href="assets/css/style.css?=<?php echo time(); ?>">
  <script src="assets/js/style.js?=<?php echo time(); ?>"></script>
  <script src="assets/js/config.js?=<?php echo time(); ?>"></script>
  <script src="assets/js/alert.js?=<?php echo time(); ?>"></script>
  <script src="https://unpkg.com/petite-vue@0.4.1/dist/petite-vue.iife.js"></script>
  <script src="assets/js/petite.config.js?=<?php echo time(); ?>"></script>
  <style>
    :root {
      --font-main:"Inter";
      --green:#298C21;
      --green-30:rgba(40,140,33,.3);;
      --gray:#939393;
      --lgray:#bebdbd;
      --line:#3A3A3A;
      --dark:#101010;
      /* linear-gradient(90deg, #0F1F13 0%, #101010 100%); */
    }
    *{ list-style: none; }
    a{ color: inherit; }
  </style>
</head>


<body class="bg-black min-h-screen" flex="col">

<header class="wrapper" flex="col">
    <div class="py-20" flex="space" data-aos="fade-down">
      <img src="assets/img/logo.svg?v=2" class="h-40 lg:h-50">
      <nav text="white bold" class="hide gap-40 lg:flex">
        <a href="index.php"><?php echo $lang["nav_about"];?></a>
        <a href="index.php#exchange"><?php echo $lang["nav_exchange"];?></a>
        <a href="index.php#how_exchange"><?php echo $lang["nav_how_to"];?></a>
        <a href="index.php#transactions"><?php echo $lang["nav_transactions"];?></a>
        <a href="index.php#support"><?php echo $lang["nav_support"];?></a>
      </nav>
      <a class="btn m-lg:hide" href="index.php#exchange"><?php echo $lang["nav_exchange"];?></a>
      <a href="inc/lang.php?page=rules"><?php echo ($_SESSION["lang"] == "ru") ? "ENG" : "RUS"; ?></a>
    </div>
</header>

<main class="wrapper my-30">
    <p class="ws-pre-line lh-2"><?php echo $lang["rules"]; ?></p>
</main>

<footer class="wrapper py-50" flex="space" data-aos="fade-up" data-aos-delay="400">
    <a href="#"><img src="assets/img/logo_small.svg"></a>
    <p text="md:24 #333 up"><?php echo $lang["footer_text"];?></p>
    <a text="md:24 #333 up" href="rules.php">terms & policy</a>
    <a target="_blank" href="<?php echo $contact; ?>"><img src="assets/img/tg.svg" alt="tg"></a>
</footer>

</body>
</html>