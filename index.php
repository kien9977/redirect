<?php
	echo '<form action ="" method="post">';
	echo 'Custom Link:<br/><input name="short"/><br/>';
	echo '<br>';
	echo 'Destination Link:<br/><input name="url"/><br/>';
	echo '<input type="submit" value="OK"></input></form>';

	if($_POST['url'] && $_POST['short']){
		$url = $_POST['url'];
		$short = $_POST['short'];

		require("db_config.php");
		if(!preg_match("/^[a-zA-Z]+[:\/\/]+[A-Za-z0-9\-_]+\\.+[A-Za-z0-9\.\/%&=\?\-_]+$/i", $url)) {
			$html = "Error: invalid URL";
		} else {

		if($short == null){
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$short = '';
			for ($i = 0; $i < 7; $i++) {
				$short .= $characters[rand(0, strlen($characters) - 1)];
			}
		}

		$sql = "select * from url_redirects where short = ('".$short."')";
		$query = mysql_query($sql);
		$num = mysql_num_rows($query);
		
		while($num != 0){
			echo "link cua ban da bi thay doi do da trung trong he thong";
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$short = '';

			for ($i = 0; $i < 7; $i++) {
				$short .= $characters[rand(0, strlen($characters) - 1)];
			}

			$sql="select * from url_redirects where short = ('".$short."')";
			$query=mysql_query($sql);
			$num=mysql_num_rows($query);
		}
		 
		if(mysql_query("INSERT INTO url_redirects (short, url, count) VALUES ('".$short."', '".$url."', 0);")) {
			$html = "re.chiaseacc.com/".$short;
		} else {
			$html = "Error: cannot find database";
		}
		  

		 
		}
		echo "Link cua ban la: ".$html;

	}

?>