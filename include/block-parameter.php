<?php defined('myeshop') or die('Доступ запрещён!'); ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#blocktrackbar').trackbar({
			onMove: function() {
				document.getElementById("start-price").value = this.leftValue;
				document.getElementById("end-price").value = this.rightValue;
			},
			width: 170,
			leftLimit: 10,
			leftValue: <?php if ((int)$_GET["start_price"] >=100 and (int)$_GET["start_price"] <= 1000) {
    echo (int)$_GET["start_price"];
} else {
    echo "10";
} ?>,
			rightLimit: 1000,
			rightValue: <?php

    if ((int)$_GET["end_price"] >= 10 and (int)$_GET["end_price"] <= 1000) {
        echo (int)$_GET["end_price"];
    } else {
        echo "1000";
    } ?>,
			roundUp: 10
		});
	});
</script>

<div id="block-parameter">
	<p class="header-title">Параметры</p>
	<p class="title-filter">Цена</p>
	<form method="GET" action="search_filter.php">
		<div id="block-input-price">
			<ul>
				<li>
					<p>от</p>
				</li>
				<li><input type="text" id="start-price" name="start_price" value="10"></li>
				<li>
					<p>до</p>
				</li>
				<li><input type="text" id="end-price" name="end_price" value="10000"></li>
				<li>
					<p>грн</p>
				</li>
			</ul>
		</div>
		<div id="blocktrackbar"></div>
		<p class="title-filter">Производитель</p>
		<ul class="checkbox-brand">
			<?php $result = mysqli_query($link, "SELECT * FROM category WHERE type='mobile'");
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                do {
                    $checked_brand = "";
                    if ($_GET["brand"]) {
                        if (in_array($row["id"], $_GET["brand"])) {
                            $checked_brand = "checked";
                        }
                    }
                    echo '<li><input '.$checked_brand.' type="checkbox" name="brand[]" value="'.$row["id"].'" id="checkbrend'.$row["id"].'"><label for="checkbrend'.$row["id"].'">'.$row["brand"].'</label></li>';
                } while ($row = mysqli_fetch_array($result));
            }
        ?>
		</ul>
		<input type="submit" name="submit" id="button-param-search" value="Найти">
	</form>
</div>
