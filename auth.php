<?php
session_start();

$s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
$user = json_decode($s, true);
                    //$user['network'] - соц. сеть, через которую авторизовался пользователь
                    //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
                    //$user['first_name'] - имя пользователя
                    //$user['last_name'] - фамилия пользователя
   if (strlen($user['network']) > 0 )
   {
     $_SESSION['auth_user'] = 'Авторизирован!';
   }else
   {
     $_SESSION['auth_user'] = 'Не авторизирован!';
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

<style type="text/css">
#block-body{
    margin: 25px auto;
    width: 800px;
    height: 500px;
    border: 1px solid #BEBEBE;
}
</style>
    <title></title>
</head>
<body>
<div id="block-body">
<p><?php echo $_SESSION['auth_user']; ?></p>
<p>Имя -  <?php echo $user['first_name']; ?></p>
<p>Фамилия -  <?php echo $user['last_name']; ?></p>
<p>Ресурс - <?php echo $user['network']; ?></p>

<script src="//ulogin.ru/js/ulogin.js"></script>
<div id="uLogin" data-ulogin="display=panel;fields=first_name,last_name;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;redirect_uri=http%3A%2F%2Fdemo.shop-training.ru/auth.php"></div>
</div>
</body>
</html>
