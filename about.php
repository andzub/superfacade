<?php
   define('myeshop', true);
   include("include/db_connect.php");
   include("functions/functions.php");
   session_start();
   include("include/auth_cookie.php");
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="trackbar/trackbar.css" rel="stylesheet">
    <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/js/jcarousellite_1.0.1.js"></script>
    <script type="text/javascript" src="/js/shop-script.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="/trackbar/jquery.trackbar.js"></script>
    <script type="text/javascript" src="/js/TextChange.js"></script>
    <title>Exmobuy</title>
  </head>

  <body>
    <section id="block-wrapper">
      <?php include("include/block-header.php"); ?>
      <main id="block-content">
        <div id="block-left">
          <?php include("include/block-category.php");
                include("include/block-parameter.php");
                // include("include/block-news.php"); ?>
        </div>
        <div id="content-container">

        </div>
      </main>
      <?php include("include/block-random.php");
              include("include/block-footer.php"); ?>
    </section>
  </body>

  </html>
