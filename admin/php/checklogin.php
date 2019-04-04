<?php
	error_reporting (E_ALL ^ E_NOTICE);
	header('Content-Type: text/html; charset=utf-8');
	function message($msg){
	    echo "<script type=\"text/javascript\">alert('$msg') </script>";
	}

	if(isset($_COOKIE['a_id']))
	{
		$a_id = $_COOKIE['a_id'];
		$a_name = $_COOKIE['a_name'];
		$a_username = $_COOKIE['a_username'];
		
		if($page == "login")
		{
			echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'>";
		}
	}
	else
	{
		setcookie("a_id", $a_id, time() - 3600*24*365,"/");
		setcookie("a_name", $a_name, time() - 3600*24*365,"/");
		setcookie("a_username", $a_username, time() - 3600*24*365,"/");
		if($page != "login")
		{
			message('กรุณาเข้าสู่ระบบ');
			echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=login.php'>";
			exit();
		}		
	}

	
?>