<?php
    session_start();
    require_once "inc/connect.php";

    
    if ($_SESSION["lang"]) {
        require "inc/" . $_SESSION["lang"] . ".php";
    
    } else {
        $_SESSION["lang"] = "en";
        require require "inc/en.php";
    }
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"];?>">

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
    }
    *{ list-style: none; }
    a{ color: inherit; }
  </style>
</head>

<body class="bg-black min-h-screen" flex="col">
  <header class="wrapper py-20" flex="space">
    <img src="assets/img/logo.svg?v=2" class="h-40 lg:h-50">
    <a href="inc/lang.php?page=404"><?php echo ($_SESSION["lang"] == "ru") ? "ENG" : "RUS"; ?></a>
  </header>

  <main class="wrapper grow mt-50" flex="col center">

    <div class="rel w-150 h-140 mb-50">
      <img src="assets/icon/crash.svg" class="abs top-2 left--4 opacity-.5">
      <img src="assets/icon/crash.svg" class="abs top-0 left-0 hue-250">
    </div>

    <!-- <p text="center" class="w-500"><?php echo $lang["error"]; ?></p> -->

    <p text="20 bold"><?php echo $lang["error"]; ?></p>
      
    <p text="center" class="max-w-500 mt-20"><?php echo $lang['error_info']; ?></p>
    

    <div flex="20">
      <a href="index.php" class="p-15+50 round-15 my-50 bg-$green-30 pointer h:opacity-0.7 time-300" flex="10 ai-c">
        <img class="hue-250 w-22 h-22" src="assets/icon/home.svg" alt="home">
        <span text="$green"><?php echo $lang["back"];?></span>
      </a>
      <a href="<?php echo "https://t.me/xpeva";?>" class="p-15+50 round-15 my-50 bg-$green-30 pointer h:opacity-0.7 time-300" flex="10 ai-c">
        <img class="hue-250 w-22 h-22" src="assets/icon/support.svg" alt="support">
        <span text="$green"><?php echo $lang["support"];?></span>
      </a>
    </div>

  </main>


  <footer class="wrapper py-20" flex="space">
    <a href="#"><img src="assets/img/logo_small.svg"></a>
    <p text="md:24 #282828"><?php echo $lang["footer_text"]; ?></p>
    <a text="md:24 #333 up" href="rules.php">terms & policy</a>
    <a href="<?php echo "https://t.me/xpeva";?>"><img src="assets/img/tg.svg" alt="tg"></a>
  </footer>

  <script src="assets/js/copy_order.js?=<?php echo time() ?>"></script>
  <script src="assets/js/main.js?=<?php echo time() ?>"></script>
</body>
</html>