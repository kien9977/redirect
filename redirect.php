<?php
	include("db_config.php");

	function Redirect($url, $permanent = true){
		header('Location: ' . $url, true, $permanent ? 301 : 302);
		exit();
	}


	$short = $_REQUEST['short'];

	$db = mysql_connect($host, $username, $password);    
	$query = mysql_query("SELECT * FROM url_redirects WHERE short = '".mysql_real_escape_string($short)."' LIMIT 1", $db);
	$row = mysql_fetch_row($query);

	if(!empty($row)) {
		$sql3 = "UPDATE url_redirects SET count = count + 1 WHERE short = ('".$short."')";
		$query3 = mysql_query($sql3);
		    
		redirect($row[2]);
	}
	else
	{
		echo "Shut up! And go back!";
	}

	mysql_close($db);
?>

