<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth") {
    define('myeshop', true);

    if (isset($_GET["logout"])) {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }

    $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='administrators.php' >Администраторы</a>";

    include("include/db_connect.php");
    include("include/functions.php");
    $id = clear_string($_GET["id"]);
    $action = $_GET["action"];
    if (isset($action)) {
        switch ($action) {

        case 'delete':
      if ($_SESSION['auth_admin_login'] == 'admin') {
          $delete = mysqli_query($link, "DELETE FROM reg_admin WHERE id = '$id'");
      } else {
          $msgerror = 'У вас нет прав на удаление администраторов!';
      }

        break;

    }
    } ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="jquery_confirm/jquery_confirm.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="jquery_confirm/jquery_confirm.js"></script>
    <title>Панель Управления - Администраторы</title>
  </head>

  <body>
    <div id="block-body">
      <?php
    include("include/block-header.php"); ?>
        <div id="block-content">
          <div id="block-parameters">
            <p id="title-page">Администраторы</p>
            <p align="right" id="add-style"><a href="add_administrators.php">Добавить админа</a></p>
          </div>

          <?php
if (isset($msgerror)) {
        echo '<p id="form-error" align="center">'.$msgerror.'</p>';
    }

    if ($_SESSION['view_admin'] == '1') {
        $result = mysqli_query($link, "SELECT * FROM reg_admin ORDER BY id DESC");

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            do {
                echo '
<ul id="list-admin" >
<li>
<h3>'.$row["fio"].'</h3>
<p><strong>Должность</strong> - '.$row["role"].'</p>
<p><strong>E-mail</strong> - '.$row["email"].'</p>
<p><strong>Телефон</strong> - '.$row["phone"].'</p>
<p class="links-actions" align="right" ><a class="green" href="edit_administrators.php?id='.$row["id"].'" >Изменить</a> | <a class="delete" rel="administrators.php?id='.$row["id"].'&action=delete" >Удалить</a></p>
</li>
</ul>
    ';
  } while ($row = mysqli_fetch_array($result));
        }
    } else {
        echo '<p id="form-error" align="center">У вас нет прав на просмотр администраторов!</p>';
    } ?>

        </div>
    </div>
  </body>

  </html>
  <?php

} else {
    header("Location: login.php");
}
?>
