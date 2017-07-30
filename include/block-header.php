<?php defined('myeshop') or die('Доступ запрещен!'); ?>

<header id="block-header">

  <!-- block-header-top -->
  <div id="block-header-top">
    <div id="header-top-container">
      <div class="logo-name">
        <h1><a href="index.php">MasterDeco</a></h1>
        <p>интернет-магазин</p>
      </div>
      <!-- Форма поиска -->
      <div id="block-search">
        <form method="GET" action="search.php?q=">
          <input type="text" id="input-search" name="q" value="<?php echo $search; ?>">
          <input type="submit" id="button-search" value="">
          <i class="fa fa-search fa-lg"></i>
        </form>

        <ul id="result-search">

        </ul>

      </div>
      <!-- Информационный блок -->
      <div id="personal-info">
        <p class="phone"><i class="fa fa-mobile fa-lg"></i>098 751 13 01</p>
        <p class="phone"><i class="fa fa-mobile fa-lg"></i>066 253 26 78</p>
        <!-- <p>Режим работы:</p>
        <p>ПН-СБ: с 8:00 до 18:00</p> -->
      </div>
    </div>
  </div>

  <!-- block-header-middle -->
  <div id="block-header-middle">
    <div id="header-middle-container">
      <nav class="header-nav">
        <ul id="header-middle-menu">
          <li><a href="index.php">Главная</a></li>
          <li><a href="about.php">О магазине</a></li>
          <li><a href="delivery_and_pay.php">Доставка и оплата</a></li>
          <li><a href="feedback.php">Контакты</a></li>
        </ul>
      </nav>

      <!-- Вход и Регистрация -->
      <?php if ($_SESSION['auth'] == 'yes_auth') {
    echo '<p id="auth-user-info">Здравствуйте, '.$_SESSION['auth_name'].'!</p>';
} else {
    echo '<p id="reg-auth-title"><a class="top-auth"><i class="fa fa-sign-in"></i>Вход</a><a class="top-reg" href="registration.php"><i class="fa fa-user"></i>Регистрация</a></p>';
} ?>

      <div id="block-top-auth">
        <div class="corner"></div>
        <form method="post">
          <ul id="input-email-pass">
            <h3>Вход</h3>
            <p id="message-auth">Неверный Логин и(или) Пароль</p>
            <li>
              <input type="text" id="auth_login" placeholder="Логин или E-mail" />
            </li>
            <li>
              <input type="password" id="auth_pass" placeholder="Пароль" /><span id="button-pass-show-hide" class="pass-show"></span>
            </li>
            <ul id="list-auth">
              <li><input type="checkbox" name="rememberme" id="rememberme" /><label for="rememberme">Запомнить меня</label></li>
              <li><a id="remindpass" href="#">Забыли пароль?</a></li>
            </ul>
            <p id="button-auth"><a>Вход</a></p>
            <p class="auth-loading"><img src="/images/loading.gif" /></p>
          </ul>
        </form>
        <div id="block-remind">
          <h3>Восстановление<br /> пароля</h3>
          <p id="message-remind" class="message-remind-success"></p>
          <input type="text" id="remind-email" placeholder="Ваш E-mail" />
          <p id="button-remind"><a>Готово</a></p>
          <p class="auth-loading"><img src="/images/loading.gif" /></p>
          <p id="prev-auth">Назад</p>
        </div>
      </div>
      <div id="block-user">
        <div class="corner2"></div>
        <ul>
          <li><img src="/images/user_info.png" /><a href="profile.php">Профиль</a></li>
          <li><img src="/images/logout.png" /><a id="logout">Выход</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- block-header-bottom -->
  <div id="block-header-bottom">
    <div id="header-bottom-container">
      <div id="bottom-menu">
        <ul>
          <li><a href="view_aystopper.php?go=news">Новинки</a></li>
          <li><a href="view_aystopper.php?go=leaders">Лидеры продаж</a></li>
          <li><a href="view_aystopper.php?go=sale">Акции</a></li>
        </ul>
      </div>
      <p id="block-basket"><i class="fa fa-shopping-cart fa-lg"></i><a href="cart.php?action=oneclick">Корзина</a></p>
      <!-- <div id="nav-line"></div> -->
    </div>
  </div>

</header>
