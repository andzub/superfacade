<?php
   define('myeshop', true);
   include("include/db_connect.php");
   include("functions/functions.php");
   session_start();
   include("include/auth_cookie.php");
   $cat = clear_string($_GET["cat"]);
   $type = clear_string($_GET["type"]);

?>
  <!DOCTYPE html>
  <html xml:lang="en" lang="en">

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

    <title>Поиск по параметрам</title>
  </head>

  <body>

    <section id="block-wrapper">
      <?php include("include/block-header.php"); ?>
      <main id="block-content">
        <div id="block-left">
          <?php
      include("include/block-category.php");
      include("include/block-parameter.php");
      // include("include/block-news.php");
  ?>
        </div>
        <div id="content-container">
          <?php

    if ($_GET["brand"]) {
        $check_brand = implode(',', $_GET["brand"]);
    }

    $start_price = (int)$_GET["start_price"];
    $end_price = (int)$_GET["end_price"];


    if (!empty($check_brand) or !empty($end_price)) {
        if (!empty($check_brand)) {
            $query_brand = "AND brand_id IN($check_brand)";
        }
        if (!empty($end_price)) {
            $query_price = "AND price BETWEEN $start_price AND $end_price";
        }
    }

    $result = mysqli_query($link, "SELECT * FROM table_products WHERE visible='1' $query_brand $query_price ORDER BY products_id DESC");

  if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);

      echo '
   <div id="block-sorting">
  <ul id="options-list">
  <!--<li>Вид: </li>-->
  <!--<li><img id="style-grid" src="/images/icon-grid.png" /></li>
  <li><img id="style-list" src="/images/icon-list.png" /></li>-->
  <li><a id="select-sort">'.$sort_name.'</a>
  <ul id="sorting-list">
  <li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-asc" >От дешевых к дорогим</a></li>
  <li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-desc" >От дорогих к дешевым</a></li>
  <li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=popular" >Популярное</a></li>
  <li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=news" >Новинки</a></li>
  </ul>
  </li>
  </ul>
  </div>

   <ul id="block-goods-grid" >
   ';
      do {
          if ($row["image"] != "" && file_exists("./uploads_images/".$row["image"])) {
              $img_path = './uploads_images/'.$row["image"];
              $max_width = 200;
              $max_height = 200;
              list($width, $height) = getimagesize($img_path);
              $ratioh = $max_height/$height;
              $ratiow = $max_width/$width;
              $ratio = min($ratioh, $ratiow);
              $width = intval($ratio*$width);
              $height = intval($ratio*$height);
          } else {
              $img_path = "/images/no-image.png";
              $width = 110;
              $height = 200;
          }

          echo '
     <li>
      <div class="block-images-grid">
        <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'">
      </div>
      <p class="style-title-grid"><a href="view_content.php?id='.$row[" products_id  "].'-'.ftranslite($row["title"]).'">'.$row["title"].'</a></p>
      <div class="mini-features">
        <p>'.$row["mini_features"].'</p>
      </div>
      <!--<ul class="reviews-and-counts-grid">
        <li><i class="fa fa-eye">
          <p>'.$row["count"].'</p>
        </li>
        <li><i class="fa fa-comment">
          <p>'.$count_reviews.'</p>
        </li>
      </ul>-->
      <div class="price-cart-box">
        <p class="style-price-grid">'.group_numerals($row["price"]).' грн.</p>
        <a class="add-cart-style-grid" tid="'.$row["products_id"].'"><i class="fa fa-shopping-cart fa-lg"></i>Купить</a>
      </div>
     </li> ';
      } while ($row = mysqli_fetch_array($result));
      ?>
            </ul>

            <ul id="block-goods-list">
              <?php
    $result = mysqli_query($link, "SELECT * FROM table_products WHERE visible='1' $query_brand $query_price ORDER BY products_id DESC");

      if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_array($result);

          do {
              if ($row["image"] != "" && file_exists("./uploads_images/".$row["image"])) {
                  $img_path = './uploads_images/'.$row["image"];
                  $max_width = 150;
                  $max_height = 150;
                  list($width, $height) = getimagesize($img_path);
                  $ratioh = $max_height/$height;
                  $ratiow = $max_width/$width;
                  $ratio = min($ratioh, $ratiow);
                  $width = intval($ratio*$width);
                  $height = intval($ratio*$height);
              } else {
                  $img_path = "/images/noimages80x70.png";
                  $width = 80;
                  $height = 70;
              }

              echo '

    <li>
    <div class="block-images-list" >
    <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
    </div>

    <ul class="reviews-and-counts-list">
    <!--<li><img src="/images/eye-icon.png" /><p>0</p></li>
    <li><img src="/images/comment-icon.png" /><p>0</p></li>-->
    </ul>

    <p class="style-title-list" ><a href="" >'.$row["title"].'</a></p>

    <a class="add-cart-style-list" ></a>
    <p class="style-price-list" ><strong>'.$row["price"].'</strong> грн.</p>
    <div class="style-text-list" >
    '.$row["mini_description"].'
    </div>
    </li>

    ';
          } while ($row = mysqli_fetch_array($result));
      }
  } else {
      echo '<h3>Категория не доступна или не создана!</3>';
  }
  ?>
            </ul>
        </div>
      </main>
      <?php include("include/block-footer.php"); ?>
    </section>

  </body>

  </html>
