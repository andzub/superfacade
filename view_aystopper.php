<?php
   define('myeshop', true);
   include("include/db_connect.php");
   include("functions/functions.php");
   session_start();
   include("include/auth_cookie.php");
    $go = clear_string($_GET["go"]);

    switch ($go) {
        case "news":
        $query_aystopper= "WHERE visible = '1' AND new = '1'";
        $name_aystopper = "Новинки товаров";
        break;
        case "leaders":
        $query_aystopper= "WHERE visible = '1' AND leader = '1'";
        $name_aystopper = "Лидеры продаж";
        break;
        case "sale":
        $query_aystopper= "WHERE visible = '1' AND sale = '1'";
        $name_aystopper = "Распродажа товаров";
        break;
        default:
        $query_aystopper = "";
        break;
}

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
}
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

    <title>FaDecoration</title>
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
          <?php
    if ($query_aystopper != "") {
        $num = 12; // Здесь указываем сколько хотим выводить товаров.
    $page = (int)$_GET['page'];

        $count = mysqli_query($link, "SELECT COUNT(*) FROM table_products $query_aystopper");
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

            $qury_start_num = "LIMIT $start, $num";
        }

        if ($temp[0] > 0) {
            ?>
            <div id="block-sorting">
              <ul id="options-list">
                <li>Сортировать:</li>
                <li>
                  <a id="select-sort"><?php echo $sort_name; ?></a><i class="fa fa-sort-down"></i>
                  <ul id="sorting-list">
                    <li><a href="view_aystopper.php?go=<?php echo $go; ?>&sort=price-asc">От дешевых к дорогим</a></li>
                    <li><a href="view_aystopper.php?go=<?php echo $go; ?>&sort=price-desc">От дорогих к дешевым</a></li>
                    <li><a href="view_aystopper.php?go=<?php echo $go; ?>&sort=popular">Популярное</a></li>
                    <li><a href="view_aystopper.php?go=<?php echo $go; ?>&sort=news">Новинки</a></li>
                  </ul>
                </li>
              </ul>
            </div>

            <ul id="block-goods-grid">
              <?php

  $result = mysqli_query($link, "SELECT * FROM table_products $query_aystopper ORDER BY $sorting $qury_start_num");

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
                    echo '
               <li>
                <div class="block-images-grid">
                  <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'">
                </div>
                <p class="style-title-grid"><a href="view_content.php?id='.$row["products_id"].'-'.ftranslite($row["title"]).'">'.$row["title"].'</a></p>
                <div class="mini-features">
                  <p>'.$row["mini_features"].'</p>
                </div>
                <div class="price-cart-box">
                  <p class="style-price-grid">'.group_numerals($row["price"]).' грн.</p>
                  <a class="add-cart-style-grid" tid="'.$row["products_id"].'"><i class="fa fa-shopping-cart fa-lg"></i>Купить</a>
                </div>
               </li> ';
                } while ($row = mysqli_fetch_array($result));
            } ?>
            </ul>

              <?php
        } else {
            echo '<p>Товаров нет!</p>';
        }
    } else {
        echo '<p>Данная категория не найдена!</p>';
    }


if ($page != 1) {
    $pstr_prev = '<li><a class="pstr-prev" href="view_aystopper.php?go='.$go.'&page='.($page - 1).'">&lt;</a></li>';
}
if ($page != $total) {
    $pstr_next = '<li><a class="pstr-next" href="view_aystopper.php?go='.$go.'&page='.($page + 1).'">&gt;</a></li>';
}


// Формируем ссылки со страницами
if ($page - 5 > 0) {
    $page5left = '<li><a href="view_aystopper.php?go='.$go.'&page='.($page - 5).'">'.($page - 5).'</a></li>';
}
if ($page - 4 > 0) {
    $page4left = '<li><a href="view_aystopper.php?go='.$go.'&page='.($page - 4).'">'.($page - 4).'</a></li>';
}
if ($page - 3 > 0) {
    $page3left = '<li><a href="view_aystopper.php?go='.$go.'&page='.($page - 3).'">'.($page - 3).'</a></li>';
}
if ($page - 2 > 0) {
    $page2left = '<li><a href="view_aystopper.php?go='.$go.'&page='.($page - 2).'">'.($page - 2).'</a></li>';
}
if ($page - 1 > 0) {
    $page1left = '<li><a href="view_aystopper.php?go='.$go.'&page='.($page - 1).'">'.($page - 1).'</a></li>';
}

if ($page + 5 <= $total) {
    $page5right = '<li><a href="view_aystopper.php?go='.$go.'&page='.($page + 5).'">'.($page + 5).'</a></li>';
}
if ($page + 4 <= $total) {
    $page4right = '<li><a href="view_aystopper.php?go='.$go.'&page='.($page + 4).'">'.($page + 4).'</a></li>';
}
if ($page + 3 <= $total) {
    $page3right = '<li><a href="view_aystopper.php?go='.$go.'&page='.($page + 3).'">'.($page + 3).'</a></li>';
}
if ($page + 2 <= $total) {
    $page2right = '<li><a href="view_aystopper.php?go='.$go.'&page='.($page + 2).'">'.($page + 2).'</a></li>';
}
if ($page + 1 <= $total) {
    $page1right = '<li><a href="view_aystopper.php?go='.$go.'&page='.($page + 1).'">'.($page + 1).'</a></li>';
}


if ($page+5 < $total) {
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="view_aystopper.php?go='.$go.'&page='.$total.'">'.$total.'</a></li>';
} else {
    $strtotal = "";
}

if ($total > 1) {
    echo '
    <div class="pstrnav">
    <ul>
    ';
    echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='view_aystopper.php?go=".$go."&page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
    echo '
    </ul>
    </div>
    ';
}


?>
        </div>
      </main>
          <?php include("include/block-footer.php"); ?>
    </section>

  </body>

  </html>
