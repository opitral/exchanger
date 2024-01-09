<?php
    session_start();
    require_once "inc/connect.php";

    $order_id = $_GET["id"];

    $result = mysqli_query($connect, "SELECT * FROM orders WHERE id='$order_id'");
    $row = mysqli_fetch_assoc($result);

    if (!$row || $row["status"] == "timeout") {
      header("Location: 404.php");
    }

    if ($_SESSION["lang"]) {
        require "inc/" . $_SESSION["lang"] . ".php";
    
    } else {
        $_SESSION["lang"] = "en";
        require require "inc/en.php";
    }

    $address = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `address` FROM `cryptos` WHERE `long_name` LIKE '{$row['send_coin']}'"))["address"];
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
      /* linear-gradient(90deg, #0F1F13 0%, #101010 100%); */
    }
    *{ list-style: none; }
    a{ color: inherit; }
  </style>
</head>

<body class="bg-black min-h-screen" flex="col">

  <!-- <div id="timer" class="abs right-0 top-200 bg-#0C2A0A p-20+30 r-10+0+0+10">
    <p>28:36</p>
  </div> -->

  <header class="wrapper py-20" flex="space">
    <img src="assets/img/logo.svg?v=2" class="h-40 lg:h-50">
    <a href="inc/lang.php?page=order&id=<?php echo $order_id; ?>"><?php echo ($_SESSION["lang"] == "ru") ? "ENG" : "RUS"; ?></a>
  </header>

  <main class="wrapper grow mt-50" flex="col center">

    <h1 text="20 md:24 lg:32 fw-600 center"><?php echo $lang["exchange"];?> <br> <?php echo "{$row['send_coin']} {$lang['on']} {$row['receive_coin']}"; ?></h1>
    <p  text="16 md:24 $lgray fw-600 center" class="mt-30"><?php echo $lang["order_id"];?> <?php echo $order_id; ?></p>

    <div id="content" flex="col ai-c">
    <?php
      if ($row["status"] == "wait") {
        echo '
        <div id="timer" class="mt-20 bg-#0C2A0A p-20+30 r-10"  text="$green bold">
          ' . $lang['timer'] . ': 00:00
        </div>

        <div class="mt-50" flex="20 m-lg:col">
          <div class="lg:w-400 bg-$dark p-30">
            <p text="18 center">' . $lang['pay'] . '</p>
            <div flex="space" class="mt-25" text="14 fw-500">
              <p>' . $lang['exchange_you_send'] . ': ' . $row['send_value'] . ' <br> ' . $row['send_coin'] . '</p>
              <p>' . $lang['exchange_you_receive'] . ': ' . $row['receive_value'] . ' <br> ' . $row['receive_coin'] . '</p>
            </div>
            <div class="rel w-full mt-15 py-10 bb-1 bc-$line" flex="ai-c">
              <img class="hue-250" src="assets/icon/coin.svg" alt="coin">
              <p class="ml-7 w-280" text="14 $green" >' . $row['send_value'] . ' ' . $row['send_coin'] . '</p>
              <span class="abs right-0 h:opacity-0.7 pointer" data-copy="' . $row['send_value'] . '" text="14 $gray">' . $lang['copy'] . '</span>
            </div>
            <div class="rel w-full mt-15 py-10 bb-1 bc-$line" flex="ai-c">
              <img class="hue-250" src="assets/icon/wallet.svg" alt="wallet">
              <p class="ml-7 w-280" text="14 $green" >' . substr($address, 0, 15) . '...</p>
              <span class="abs right-0 h:opacity-0.7 pointer" data-copy="' . $address . '" text="14 $gray">' . $lang['copy'] . '</span>
            </div>
            <a href="inc/pay.php?id=' . $order_id . '" class="btn_green pointer">' . $lang['confirm'] . '</a>
          </div>

          <div class="lg:w-400 bg-$dark p-30" flex="25 col center">
            <p text="18 fw-500 center">' . $lang['qr'] . '</p>
            <img class="round-5" src="https://chart.googleapis.com/chart?chs=177x177&cht=qr&chl=' . $address . '&choe=UTF-8" alt="QR code">
          </div>
        </div>
        ';

      } elseif ($row["status"] == "pay") {
        echo '
          <div class="py-30 px-50 md:px-100 grad-90+#0D1C10+#101010 r-10 mt-50" flex="20 col center">
            <p text="14 md:18 500 center" style="color: green">' . $lang['waiting'] . '</p>
            <div text="md:20 bold center">' . $lang['waiting_info'] . '</div>
          </div>
          <script>setTimeout(function() { location.reload(); }, 10000)</script>
        ';



      } elseif ($row["status"] == "done") {
        echo '
          <div flex="20 col center" class="mt-50">
            <svg class="m-md:w-50 m-md:h-50" width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M50 91.6666C73.0118 91.6666 91.6667 73.0118 91.6667 49.9999C91.6667 26.9881 73.0118 8.33325 50 8.33325C26.9881 8.33325 8.33331 26.9881 8.33331 49.9999C8.33331 73.0118 26.9881 91.6666 50 91.6666Z" stroke="#139D00" stroke-width="8.33333" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M70.3044 35.2642L41.0424 64.5254L30.0229 53.4133" stroke="#139D00" stroke-width="8.33333" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          
            <p text="20 bold">' . $lang['success'] . '</p>
      
            <p text="center" class="max-w-500">' . $lang['success_info_1'] . $row['receive_value'] . ' ' . $row['receive_coin'] . $lang['success_info_2'] . $row['address'] . $lang['success_info_3'] . '</p>
          </div>
        ';

      } elseif ($row["status"] == "error") {
        echo '
          <div flex="20 col center" class="mt-50">
            <svg class="m-md:w-50 m-md:h-50" width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M42.875 16.0832L7.58336 74.9999C6.85573 76.26 6.47072 77.6886 6.46665 79.1437C6.46257 80.5988 6.83957 82.0296 7.56014 83.2937C8.2807 84.5579 9.31972 85.6113 10.5738 86.3493C11.8279 87.0872 13.2534 87.4839 14.7084 87.4999H85.2917C86.7467 87.4839 88.1721 87.0872 89.4262 86.3493C90.6803 85.6113 91.7193 84.5579 92.4399 83.2937C93.1605 82.0296 93.5375 80.5988 93.5334 79.1437C93.5293 77.6886 93.1443 76.26 92.4167 74.9999L57.125 16.0832C56.3822 14.8587 55.3364 13.8462 54.0883 13.1436C52.8403 12.4409 51.4323 12.0718 50 12.0718C48.5678 12.0718 47.1597 12.4409 45.9117 13.1436C44.6637 13.8462 43.6178 14.8587 42.875 16.0832Z" stroke="#A8990F" stroke-width="8.33333" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M50 37.5V54.1667" stroke="#A8990F" stroke-width="8.33333" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M50 70.8335H50.0417" stroke="#A8990F" stroke-width="8.33333" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          
            <p text="20 bold">' . $lang['error'] . '</p>
      
            <p text="center" class="max-w-500">' . $lang['error_info'] . '</p>
          </div>
        ';
      }
    ?>
    </div>



    <div flex="20">
      <a href="index.php" class="py-15 px-20 md:px-50 round-15 my-50 bg-$green-30 pointer h:opacity-0.7 time-300" flex="10 ai-c">
        <img class="hue-250 w-22 h-22" src="assets/icon/home.svg" alt="home">
        <span text="14 md:16 $green"><?php echo $lang["back"];?></span>
      </a>
      <a href="<?php echo "https://t.me/xpeva";?>" class="py-15 px-20 md:px-50 round-15 my-50 bg-$green-30 pointer h:opacity-0.7 time-300" flex="10 ai-c">
        <img class="hue-250 w-22 h-22" src="assets/icon/support.svg" alt="support">
        <span text="14 md:16 $green"><?php echo $lang["support"];?></span>
      </a>
    </div>

  </main>


  <footer class="wrapper py-20" flex="space">
    <a href="#"><img src="assets/img/logo_small.svg"></a>
    <p text="md:24 #282828"><?php echo $lang["footer_text"]; ?></p>
    <a text="md:24 #333 up" href="rules.php">terms & policy</a>
    <a href="<?php echo "https://t.me/xpeva";?>"><img src="assets/img/tg.svg" alt="tg"></a>
  </footer>

  <?php echo "<script>window.db_time = " . intval($row["timeout"]) . "</script>";?>

  <script src="assets/js/timer.js?=<?php echo time() ?>""></script>
  <script src="assets/js/copy_order.js?=<?php echo time() ?>"></script>
  <script src="assets/js/main.js?=<?php echo time() ?>"></script>
</body>
</html>