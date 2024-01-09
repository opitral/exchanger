<?php
  session_start();
  require_once "inc/connect.php";


  if ($_SESSION["lang"]) {
    require "inc/" . $_SESSION["lang"] . ".php";

  } else {
    $_SESSION["lang"] = "en";
    require "inc/en.php";
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
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <style>
    :root {
      --font-main:"Inter";
      --green:#298C21;
      --gray:#939393;
    }
    *{ list-style: none; }
    a{ color: inherit; }
  </style>
</head>

<body class="bg-black ">

  <header class="wrapper h-screen" flex="col">
    <div class="py-20" flex="space" data-aos="fade-down">
      <img src="assets/img/logo.svg?v=2" class="h-40 lg:h-50">
      <nav text="white bold" class="hide gap-40 lg:flex">
        <a href="#"><?php echo $lang["nav_about"];?></a>
        <a href="#exchange"><?php echo $lang["nav_exchange"];?></a>
        <a href="#how_exchange"><?php echo $lang["nav_how_to"];?></a>
        <a href="#transactions"><?php echo $lang["nav_transactions"];?></a>
        <a href="#support"><?php echo $lang["nav_support"];?></a>
      </nav>
      <a class="btn m-lg:hide" href="#exchange"><?php echo $lang["nav_exchange"];?></a>
      <a href="inc/lang.php?page=index&ref=<?php echo $ref; ?>"><?php echo ($_SESSION["lang"] == "ru") ? "ENG" : "RUS"; ?></a>
    </div>
    

    <div text="center white" flex="col center 20 lg:30 grow">
      <h1 text="36 md:54" data-aos="fade-up">
        <?php echo $lang["hero_title_part_1"];?> <br>
        <?php echo $lang["hero_title_part_2"];?> 
        <span text="$green"><?php echo $lang["hero_title_part_3"];?></span>
      </h1>
      <p class="max-w-780" text="md:18 $gray" data-aos="fade-up" data-aos-delay="100" data-aos-offset="0">
        <?php echo $lang["hero_subtitle"];?>
      </p>
      <img src="assets/img/crypto.png" data-aos="fade-up" data-aos-delay="200" data-aos-offset="0">
      <p text="md:18" data-aos="fade-up" data-aos-delay="300" data-aos-offset="0">
        <?php echo $lang["another_coins"];?>
      </p>
      <a class="btn" href="#exchange" data-aos="fade-up" data-aos-delay="400" data-aos-offset="0">
        <?php echo $lang["nav_exchange"];?>
      </a>
    </div>
  </header>


  <main class="wrapper text-white md:mt-100 over-x-hidden" id="exchange">
    <p  text="$gray md:20 center"data-aos="fade-up"><?php echo $lang["exchange_title"];?></p>
    <h2 text="30 md:48 center"   data-aos="fade-up" class="lg:w-950 lg:center"><?php echo $lang["exchange_subtitle"];?></h2>

    <form method="post" data-aos="fade-up" data-aos-delay="200" action="inc/order.php" class="center md:mb-100 md:mt-50 max-w-780" id="mainForm">
      <div class="flex-space m-md:col my-20 gap-10 md:gap-40">

        <div class="dropdown send rel z-9">
          <div class="label pointer">
            <p class="bold"><?php echo mb_strtoupper($lang["exchange_you_send"], "UTF-8");?></p>
            <img src="assets/img/select.svg">
          </div>
          <div class="container">
            <div class="pointer" v-for="token of Object.keys(currency)" @click="getTokenId(token,'send')">
              <img class="h-60" :src="`assets/img/tokens/${token.toLowerCase()}.svg?t=2`">
            </div>
          </div>
        </div>

        <img src="assets/img/arrow.svg" class="m-md:hide">

        <div class="dropdown receive">
          <div class="label pointer">
            <p class="bold"><?php echo mb_strtoupper($lang["exchange_you_receive"], "UTF-8");?></p>
            <img src="assets/img/select.svg">
          </div>
          <div class="container">
            <div class="pointer" v-for="token of Object.keys(currency)" @click="getTokenId(token,'receive')">
              <img class="h-60" :src="`assets/img/tokens/${token.toLowerCase()}.svg?t=2`">
            </div>
          </div>
        </div>
      </div>

      <div class="mt-20">
        <p text="20 bold $gray"><?php echo $lang["exchange_fields"];?></p>

        <div class="gap-40 mt-20 m-md:col" id="sumInputs">
          <div class="flex-col gap-10 grow">
            <p text="20 bold up">{{currency[choosed.send].long_name}}</p>
            <p text="14 $gray">
              <?php echo $lang["exchange_you_send"];?> ({{currency[choosed.send].min_limit}} — {{currency[choosed.send].max_limit}})
            </p>
            <input name="send_value" type="number" step="any" :placeholder="currency[choosed.send].min_limit" @input="inputCalc(0)" @blur="inputCalc(0,true)" v-model="inp1">
          </div>
          <div class="flex-col gap-10 grow">
            <p text="20 bold up" >{{currency[choosed.receive].long_name}}</p>
            <p text="14 $gray">
              <?php echo $lang["exchange_you_receive"];?> ({{currency[choosed.receive].min_limit}} — {{currency[choosed.receive].max_limit}})
            </p>
            <input name="receive_value" type="number" :placeholder="currency[choosed.receive].min_limit" @input="inputCalc(1)" @blur="inputCalc(1,true)" v-model="inp2">
          </div>
        </div>
      </div>

      <div class="flex-col gap-20 mt-40">
        <input name="address"      type="text"   id="inpAdrss" v-model="formAdrss" placeholder="<?php echo $lang["exchange_address"];?>">
        <input name="mail"         type="email"  id="inpEmail" v-model="formEmail" placeholder="<?php echo $lang["exchange_email"];?>">
        <input name="send_coin"    type="hidden" :value="currency[choosed.send].long_name">
        <input name="receive_coin" type="hidden" :value="currency[choosed.receive].long_name">
      </div>

      <div class="mt-20">
        <p text="20 bold">
          <span>{{captcha[0]}} + {{captcha[1]}} = </span>
          <input @input="captchaInp" class="h-40 w-60 p-10" id="captcha" type="number" v-model="captchaVal">
        </p>
      </div>

      <div class="jc-c mt-20" >
        <input @click="sendMainForm" type="submit" class="btn w-200 grow" value="<?php echo $lang["exchange_button"];?>">
      </div>
    </form>

    



    <div flex="space m-lg:col" class="mt-150 mb-50" id="how_exchange">
      <div flex="col 30" data-aos="fade-right">
        <p text="md:20 bold $gray m-lg:center"><?php echo $lang["how_to_step_title"];?></p>
        <h2 text="30 lg:48 bold m-lg:center"><?php echo $lang["how_to_subtitle_part_1"];?> <br><?php echo $lang["how_to_subtitle_part_2"];?></h2>
        <img src="assets/img/steps.png">
      </div>
      <img class="md:w-480" data-aos="fade-left" data-aos-delay="200" src="assets/img/steps2.png">
    </div>


    <div flex="50 jc-sb m-lg:col">
      <div class="p-40 bg-#101010 round-25" flex="24 col" data-aos="flip-left" data-aos-delay="100">
        <p class="label"><?php echo $lang["how_to_step_1"];?></p>
        <p text="24 lg:30 bold"><?php echo $lang["how_to_step_1_title"];?></p>
        <p text="#313131 bold"><?php echo $lang["how_to_step_1_subtitle"];?></p>
        <input type="text" placeholder="<?php echo $lang["how_to_step_1_placeholder"];?>" id="bunusInp">
        <button class="btn" @click="getBonus"><?php echo $lang["how_to_step_1_button"];?></button>
      </div>

        
      <div class="p-40 bg-#101010 round-25" flex="24 col" data-aos="flip-left" data-aos-delay="200">
        <p class="label"><?php echo $lang["how_to_step_2"];?></p>
        <p text="24 lg:30 bold"><?php echo $lang["how_to_step_2_title"];?></p>
        <p text="#313131 bold"><?php echo $lang["how_to_step_2_subtitle"];?></p>
        <img src="assets/img/1.png">
      </div>

      <div class="p-40 bg-#101010 round-25" flex="24 col" data-aos="flip-left" data-aos-delay="300">
        <p class="label"><?php echo $lang["how_to_step_3"];?></p>
        <p text="24 lg:30 bold"><?php echo $lang["how_to_step_3_title"];?></p>
        <p text="#313131 bold"><?php echo $lang["how_to_step_3_subtitle"];?></p>
        <img src="assets/img/2.png">
      </div>
    </div>

    <div class="mt-100" id="transactions" data-aos="zoom-out">
      <h2 text="34 bold center" class="live_circle"><?php echo $lang["transactions_title"];?></h2>

      <div class="m-lg:over-x-scroll mt-40">
        <div class="min-w-1000 w-full">
          <div class="bg-#298C21 round-10 p-30 mb-20" flex="space">
            <p><?php echo $lang["transactions_hash"];?></p>
            <p><?php echo $lang["transactions_block"];?></p>
            <p><?php echo $lang["transactions_from"];?></p>
            <p><?php echo $lang["transactions_to"];?></p>
            <p><?php echo $lang["transactions_amount"];?></p>
            <p><?php echo $lang["transactions_time"];?></p>
          </div>
  
          <div v-for="item of transactions" class="bg-#101010 round-10 p-30 mb-20" flex="space">
            <p>{{item[0]}}</p>
            <p>{{item[1]}}</p>
            <p>{{item[2]}}</p>
            <p>{{item[3]}}</p>
            <p>{{item[4]}}</p>
            <p text="$green"><?php echo $lang["transactions_when"];?></p>
          </div>
  
          
        </div>
      </div>
    </div>

    <div flex="20 col center" class="my-50 md:my-150" id="support" >
      <img src="assets/img/logo.svg?v=2" alt="логотип" class="m-md:h-40" data-aos="fade-down">
      <h2 text="24 md:38 m-md:center" data-aos="fade-down" data-aos-delay="100"><?php echo $lang["support_title"];?></h2>
      <p text="md:18 $gray m-md:center" data-aos="fade-down" data-aos-delay="200"><?php echo $lang["support_subtitle"];?></p>
      <a target="_blank" href="https://t.me/xpeva" class="btn" data-aos="fade-down" data-aos-delay="300">
        <img src="assets/img/tg.svg" alt="tg">
        <span><?php echo $lang["support_button"];?></span>
      </a>
    </div>
  </main>

  <footer class="wrapper py-50" flex="space" data-aos="fade-up" data-aos-delay="400">
    <a href="#"><img src="assets/img/logo_small.svg"></a>
    <p text="md:24 #333 up"><?php echo $lang["footer_text"];?></p>
    <a text="md:24 #333 up" href="rules.php">terms & policy</a>
    <a target="_blank" href="https://t.me/xpeva"><img src="assets/img/tg.svg" alt="tg"></a>
  </footer>

  <?php
    $result = mysqli_query($connect, "SELECT * FROM cryptos");

    echo "<script> var currency = {";
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['short_name'] == "rub") {
        echo "'{$row['short_name']}': {value: false, short_name: '{$row['short_name']}', long_name: '{$row['long_name']}', min_limit: '{$row['min_limit']}', max_limit: '{$row['max_limit']}', value: 1}, ";
      
      } else {
        echo "'{$row['short_name']}': {value: false, short_name: '{$row['short_name']}', long_name: '{$row['long_name']}', min_limit: '{$row['min_limit']}', max_limit: '{$row['max_limit']}'}, ";
      }
      
    }
    echo "}; </script>";
  ?>

  <script>
    var cfg = {
      aftComma: 5,
      plusPercent: 6
    }
  </script>

  <script src="assets/js/main.js?=<?php echo time(); ?>"></script>  
  <script src="assets/js/transaction.js?=<?php echo time(); ?>"></script>


  

  <?php 
    echo "<script>
      dt.formRefer = '{$ref}'
      document.currentScript.remove()
    </script>" 
  ?>


<script>AOS.init({
  // duration: 200,
})</script>
  
</body>
</html>