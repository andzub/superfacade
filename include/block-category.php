<?php defined('myeshop') or die('Доступ запрещён!'); ?>

<div id="block-category">
	<p class="header-title">Категории</p>
	<ul>

		<!-- cat 1 -->
		<li>
			<a id="index1">Пенопласт</a>
			<ul class="category-section">
				<li><a href="view_cat.php?type=penoplast"><strong>Все товары</strong></a></li>
<?php $result = mysqli_query($link, "SELECT * FROM category WHERE type='penoplast'");
 if (mysqli_num_rows($result) > 0) {
     $row = mysqli_fetch_array($result);
     do {
         echo '<li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>';
     } while ($row = mysqli_fetch_array($result));
 }
?>
			</ul>
		</li>

		<!-- cat 2 -->
		<li>
			<a id="index2">Сухие смеси</a>
			<ul class="category-section">
				<li><a href="view_cat.php?type=notebook"><strong>Все товары</strong></a></li>
<?php $result = mysqli_query($link, "SELECT * FROM category WHERE type='notebook'");
 if (mysqli_num_rows($result) > 0) {
     $row = mysqli_fetch_array($result);
     do {
         echo '<li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>';
     } while ($row = mysqli_fetch_array($result));
 }
?>
			</ul>
		</li>

		<!-- cat 3 -->
		<li>
			<a id="index3">Лакокрасочные материалы</a>
			<ul class="category-section">
				<li><a href="view_cat.php?type=notepad"><strong>Все товары</strong></a></li>
<?php $result = mysqli_query($link, "SELECT * FROM category WHERE type='notepad'");
 if (mysqli_num_rows($result) > 0) {
     $row = mysqli_fetch_array($result);
     do {
         echo '<li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>';
     } while ($row = mysqli_fetch_array($result));
 }
?>
			</ul>
		</li>

		<!-- cat 4 -->
		<li>
			<a id="index4">Армирующая сетка</a>
			<ul class="category-section">
				<li><a href="view_cat.php?type=notepad"><strong>Все товары</strong></a></li>
<?php $result = mysqli_query($link, "SELECT * FROM category WHERE type='notepad'");
 if (mysqli_num_rows($result) > 0) {
     $row = mysqli_fetch_array($result);
     do {
         echo '<li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>';
     } while ($row = mysqli_fetch_array($result));
 }
?>
			</ul>
		</li>

		<!-- cat 5 -->
		<li>
			<a id="index5">Крепежи</a>
			<ul class="category-section">
				<li><a href="view_cat.php?type=notepad"><strong>Все товары</strong></a></li>
<?php $result = mysqli_query($link, "SELECT * FROM category WHERE type='notepad'");
 if (mysqli_num_rows($result) > 0) {
     $row = mysqli_fetch_array($result);
     do {
         echo '<li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>';
     } while ($row = mysqli_fetch_array($result));
 }
?>
			</ul>
		</li>
	</ul>

</div>
