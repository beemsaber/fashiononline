<?php
	error_reporting (E_ALL ^ E_NOTICE);
	header('Content-Type: text/html; charset=utf-8');
	function message($msg){
	    echo "<script type=\"text/javascript\">alert('$msg') </script>";
	}

	if(isset($_COOKIE['fashionuser_id']))
	{
		$fashionuser_id = $_COOKIE['fashionuser_id'];
		$fashionuser_name = $_COOKIE['fashionuser_name'];
		$fashionuser_username = $_COOKIE['fashionuser_username'];
		
		if($page == "login" or $page == "login_register")
		{
			echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'>";
		}
	}
	else
	{
		setcookie("fashionuser_id", $fashionuser_id, time() - 3600*24*365,"/");
		setcookie("fashionuser_name", $fashionuser_name, time() - 3600*24*365,"/");
		setcookie("fashionuser_username", $fashionuser_username, time() - 3600*24*365,"/");

		if($page != "login" and $page != "login_register")
		{
			if($actionpage == "checkout")
			{
				message('กรุณาสมัครสมาชิก หรือ เข้าสู่ระบบ');
				echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=login_register.php?actionpage=$actionpage'>";
				exit();
			}
			else
			{
				message('กรุณาสมัครสมาชิก หรือ เข้าสู่ระบบ');
				echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=login_register.php'>";
				exit();
			}
		}
			
	}
?>