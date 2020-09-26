<?php
	$host='localhost';
	$username='chiaseacc';
	$password='chiaseacc.com';
	$database='redirect';

	$con = mysql_connect($host,$username,$password,$database) or die('không thể kết nối tới cơ sở dữ liệu');

	mysql_select_db($database,$con);


?>