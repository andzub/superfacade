<?php
defined('myeshop') or die('Доступ запрещен!');

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "db_shop");

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Ошибка подключения MySQL: " . mysqli_connect_error();
  }
// Change character set to utf8
mysqli_set_charset($link,"utf8");

// mysqli_close($link);
?>
