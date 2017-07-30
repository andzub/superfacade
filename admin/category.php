<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth") {
    define('myeshop', true);

    if (isset($_GET["logout"])) {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }

    $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='category.php' >Категории</a>";

    include("include/db_connect.php");
    include("include/functions.php");
    if ($_POST["submit_cat"]) {
        if ($_SESSION['add_category'] == '1') {
            $error = array();

            if (!$_POST["cat_type"]) {
                $error[] = "Укажите тип товара!";
            }
            if (!$_POST["cat_brand"]) {
                $error[] = "Укажите название категории!";
            }

            if (count($error)) {
                $_SESSION['message'] = "<p id='form-error'>".implode('<br />', $error)."</p>";
            } else {
                $cat_type = clear_string($_POST["cat_type"]);
                $cat_brand = clear_string($_POST["cat_brand"]);

                mysqli_query($link, "INSERT INTO category(type,brand)
						VALUES(
                            '".$cat_type."',
                            '".$cat_brand."'
						)");

                $_SESSION['message'] = "<p id='form-success'>Категория успешно добавлена!</p>";
            }
        } else {
            $msgerror = 'У вас нет прав на добавление категорий!';
        }
    } ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <title>Панель Управления - Категории</title>
  </head>

  <body>
    <div id="block-body">
      <?php
    include("include/block-header.php"); ?>
        <div id="block-content">
          <div id="block-parameters">
            <p id="title-page">Категории</p>
          </div>
          <?php
if (isset($msgerror)) {
        echo '<p id="form-error" align="center">'.$msgerror.'</p>';
    }

    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    } ?>
            <form method="post">
              <ul id="cat_products">
                <li>
                  <label>Категории</label>
                  <div>
                    <?php
    if ($_SESSION['delete_category'] == '1') {
        echo '<a class="delete-cat">Удалить</a>';
    } ?>

                  </div>
                  <select name="cat_type" id="cat_type" size="10">

<?php
$result = mysqli_query($link, "SELECT * FROM category ORDER BY type DESC");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        do {
            echo '
       <option value="'.$row["id"].'">'.$row["type"].' - '.$row["brand"].'</option>
    ';
	} while ($row = mysqli_fetch_array($result));
    } ?>

                  </select>
                </li>
                <li>
                  <label>Тип товара</label>
                  <input type="text" name="cat_type" />
                </li>
                <li>
                  <label>Бренд</label>
                  <input type="text" name="cat_brand" />
                </li>
              </ul>
              <p align="right"><input type="submit" name="submit_cat" id="submit_form" /></p>
            </form>
        </div>
    </div>
  </body>

  </html>
  <?php

} else {
    header("Location: login.php");
}
?>
