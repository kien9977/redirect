<?php
	require("db_config.php");

	$url = $_REQUEST['url'];
	$short = $_REQUEST['short'];

	if(!preg_match("/^[a-zA-Z]+[:\/\/]+[A-Za-z0-9\-_]+\\.+[A-Za-z0-9\.\/%&=\?\-_]+$/i", $url)) {
		$html = "Error: invalid URL";
	}
	else{
		if($short == null){
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$short = '';
			for ($i = 0; $i < 7; $i++) {
				$short .= $characters[rand(0, strlen($characters) - 1)];
			}
		}

		$sql = "SELECT * FROM url_redirects WHERE short = ('".$short."')";
		$query = mysql_query($sql);
		$num = mysql_num_rows($query);
		while($num != 0){
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$short = '';
			for ($i = 0; $i < 7; $i++) {
				$short .= $characters[rand(0, strlen($characters) - 1)];
			}
			$sql="SELECT * FROM url_redirects WHERE short = ('".$short."')";
			$query=mysql_query($sql);
			$num=mysql_num_rows($query);
		}

		if(mysql_query("INSERT INTO url_redirects (short, url, count) VALUES ('".$short."', '".$url."', 0);")) {
			$html = "re.chiaseacc.com/".$short;
		} else {
			$html = "Error: cannot find database";
		}

		echo $html;
	}
?>