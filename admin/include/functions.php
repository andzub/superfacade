<?php
	defined('myeshop') or die('Доступ запрещен!');
function clear_string($cl_str)
{

 $cl_str = strip_tags($cl_str);
 $cl_srt =htmlspecialchars($cl_str);
 // $cl_str = mysql_real_escape_string($cl_str);
 $cl_str = trim($cl_str);

  return $cl_str;
}

?>
