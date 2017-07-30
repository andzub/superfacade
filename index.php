<?php
   define('myeshop', true);
   include("include/db_connect.php");
   include("functions/functions.php");
   session_start();
   include("include/auth_cookie.php");

$sorting = $_GET["sort"];
switch ($sorting) {
    case 'price-asc':
    $sorting = 'price ASC';
    $sort_name = 'От дешевых к дорогим';
    break;
    case 'price-desc':
    $sorting = 'price DESC';
    $sort_name = 'От дорогих к дешевым';
    break;
    case 'popular':
    $sorting = 'count DESC';
    $sort_name = 'Популярное';
    break;
    case 'news':
    $sorting = 'datetime DESC';
    $sort_name = 'Новинки';
    break;
    default:
    $sorting = 'products_id DESC';
    $sort_name = 'По умолчанию';
    break;
} ?>
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
    <link href="owl-carousel/owl.carousel.css" rel="stylesheet">
    <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/js/jcarousellite_1.0.1.js"></script>
    <script type="text/javascript" src="/js/shop-script.js"></script>
    <script type="text/javascript" src="/owl-carousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="/trackbar/jquery.trackbar.js"></script>
    <script type="text/javascript" src="/js/TextChange.js"></script>
    <title>Exmobuy</title>

  </head>

  <body>
    <section id="block-wrapper">
      <?php include("include/block-header.php"); ?>
      <div class="banner-box">
        <div class="banner-box-container">
          <div class="text-banner-box">
            <h2 class="title-banner">Комплексное утепление фасада</h2>
            <p class="description-banner">Сделайте Ваш дом теплым и красивым</p>
          </div>
          <div class="carousel-box">
            <div id="owl-demo">
              <div class="item"><img src="/images/facade.jpg" alt="Owl Image"></div>
              <div class="item"><img src="/images/facade_1.jpg" alt="Owl Image"></div>
              <div class="item"><img src="/images/facade_2.jpg" alt="Owl Image"></div>
            </div>
          </div>
        </div>
      </div>
      <main id="block-content">
        <div id="block-left">
          <?php include("include/block-category.php");
                include("include/block-parameter.php");
                // include("include/block-news.php"); ?>
        </div>
        <div id="content-container">
          <div id="block-sorting">
            <ul id="options-list">
              <li>Сортировать:</li>
              <li>
                <a id="select-sort"><?php echo $sort_name; ?><i class="fa fa-sort-down"></i></a>
                <ul id="sorting-list">
                  <li><a href="index.php?sort=price-asc">От дешевых к дорогим</a></li>
                  <li><a href="index.php?sort=price-desc">От дорогих к дешевым</a></li>
                  <li><a href="index.php?sort=popular">Популярное</a></li>
                  <li><a href="index.php?sort=news">Новинки</a></li>
                </ul>
              </li>
            </ul>
          </div>

          <!-- Вывод товара блоком -->
          <ul id="block-goods-grid">
            <?php $num = 12; // Здесь указываем сколько хотим выводить товаров.
              $page = (int)$_GET['page'];
                $count = mysqli_query($link, "SELECT COUNT(*) FROM table_products WHERE visible = '1'");
              $temp = mysqli_fetch_array($count);

                if ($temp[0] > 0) {
                    $tempcount = $temp[0];

                    // Находим общее число страниц
                    $total = (($tempcount - 1) / $num) + 1;
                    $total =  intval($total);
                    $page = intval($page);
                    if (empty($page) or $page < 0) {
                        $page = 1;
                    }
                    if ($page > $total) {
                        $page = $total;
                    }

                    // Вычисляем начиная с какого номера
                  // следует выводить товары
                     $start = $page * $num - $num;
                    $qury_start_num = " LIMIT $start, $num";
                }

                $result = mysqli_query($link, "SELECT * FROM table_products WHERE visible='1' ORDER BY $sorting $qury_start_num ");
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
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

                    // Количество отзывов
                    $query_reviews = mysqli_query($link, "SELECT * FROM table_reviews WHERE products_id = '{$row["products_id"]}' AND moderat='1'");
                        $count_reviews = mysqli_num_rows($query_reviews);

                        echo '
                   <li>
                    <div class="block-images-grid">
                      <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'">
                    </div>
                    <p class="style-title-grid"><a href="view_content.php?id='.$row["products_id"].'-'.ftranslite($row["title"]).'">'.$row["title"].'</a></p>
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
                } ?>
          </ul>

          <!-- Вывод товара списком -->
          <ul id="block-goods-list">
            <?php $result = mysqli_query($link, "SELECT * FROM table_products WHERE visible='1' ORDER BY $sorting $qury_start_num");

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

                // Количество отзывов
                $query_reviews = mysqli_query($link, "SELECT * FROM table_reviews WHERE products_id = '{$row["products_id"]}' AND moderat='1'");
                    $count_reviews = mysqli_num_rows($query_reviews);
                    echo '
                <li>
                <div class="block-images-list">
                <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'">
                </div>
                <!--<ul class="reviews-and-counts-list">
                <li><img src="/images/eye-icon.png" />
                <p>'.$row["count"].'</p>
                </li>
                <li><img src="/images/comment-icon.png" />
                <p>'.$count_reviews.'</p>
                </li>
                </ul>-->
                <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                <a class="add-cart-style-list" tid="'.$row["products_id"].'">Купить</a>
                <p class="style-price-list">'.group_numerals($row["price"]).' грн.</p>
                <div class="style-text-list">
                '.$row["mini_description"].'
                </div>
                </li>';
                } while ($row = mysqli_fetch_array($result));
            } ?>
          </ul>

<?php
if ($page != 1) {
                $pstr_prev = '<li><a class="pstr-prev" href="index.php?page='.($page - 1).'">&lt;</a></li>';
            }
if ($page != $total) {
    $pstr_next = '<li><a class="pstr-next" href="index.php?page='.($page + 1).'">&gt;</a></li>';
}

// Формируем ссылки со страницами
if ($page - 5 > 0) {
    $page5left = '<li><a href="index.php?page='.($page - 5).'">'.($page - 5).'</a></li>';
}
if ($page - 4 > 0) {
    $page4left = '<li><a href="index.php?page='.($page - 4).'">'.($page - 4).'</a></li>';
}
if ($page - 3 > 0) {
    $page3left = '<li><a href="index.php?page='.($page - 3).'">'.($page - 3).'</a></li>';
}
if ($page - 2 > 0) {
    $page2left = '<li><a href="index.php?page='.($page - 2).'">'.($page - 2).'</a></li>';
}
if ($page - 1 > 0) {
    $page1left = '<li><a href="index.php?page='.($page - 1).'">'.($page - 1).'</a></li>';
}

if ($page + 5 <= $total) {
    $page5right = '<li><a href="index.php?page='.($page + 5).'">'.($page + 5).'</a></li>';
}
if ($page + 4 <= $total) {
    $page4right = '<li><a href="index.php?page='.($page + 4).'">'.($page + 4).'</a></li>';
}
if ($page + 3 <= $total) {
    $page3right = '<li><a href="index.php?page='.($page + 3).'">'.($page + 3).'</a></li>';
}
if ($page + 2 <= $total) {
    $page2right = '<li><a href="index.php?page='.($page + 2).'">'.($page + 2).'</a></li>';
}
if ($page + 1 <= $total) {
    $page1right = '<li><a href="index.php?page='.($page + 1).'">'.($page + 1).'</a></li>';
}

if ($page+5 < $total) {
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="index.php?page='.$total.'">'.$total.'</a></li>';
} else {
    $strtotal = "";
}

if ($total > 1) {
    echo '<div class="pstrnav"><ul>';
    echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='index.php?page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
    echo '</ul></div>';
} ?>
        </div>
      </main>
      <?php include("include/block-random.php");
              include("include/block-footer.php"); ?>
    </section>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#owl-demo").owlCarousel({
          autoPlay: 3000, //Set AutoPlay to 3 seconds
          items : 1,
          itemsDesktop : [299,3],
          itemsDesktopSmall : [179,3]
        });
      });
    </script>

  </body>

  </html>
