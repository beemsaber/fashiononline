<?php
error_reporting (E_ALL ^ E_NOTICE);
include("../inc/connect.php");
$db = new database();
$con = $db->connect();

if(isset($_POST['login']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$remember_check = $_POST['remember_check'];
	$actionpage = $_POST['actionpage'];
	
	$sql = "SELECT * FROM user WHERE user_username = '$username'";
	$sql .= " AND user_password = '$password' ";
	$query_user = $con->query($sql);
	$num_user = $query_user->num_rows;

	if($num_user > 0)
	{
		$result_user = $query_user->fetch_object();
		$fashionuser_id = $result_user->user_id;
		$fashionuser_name = $result_user->user_name;
		$fashionuser_username = $result_user->user_username;

		if($remember_check == "true")
		{
			setcookie("fashionuser_id", $fashionuser_id, time() + 3600*24*365,"/");
			setcookie("fashionuser_name", $fashionuser_name, time() + 3600*24*365,"/");
			setcookie("fashionuser_username", $fashionuser_username, time() + 3600*24*365,"/");
			if($actionpage != "checkout")
			{
				echo "yes";
			}
			else
			{
				echo "checkout";
			}
		}
		else
		{
			setcookie("fashionuser_id", $fashionuser_id, time() + 3600,"/");
			setcookie("fashionuser_name", $fashionuser_name, time() + 3600,"/");
			setcookie("fashionuser_username", $fashionuser_username, time() + 3600,"/");
			if($actionpage != "checkout")
			{
				echo "yes";
			}
			else
			{
				echo "checkout";
			}
		}
	}
	else
	{
		setcookie("fashionuser_id", $fashionuser_id, time() - 3600*24*365,"/");
		setcookie("fashionuser_name", $fashionuser_name, time() - 3600*24*365,"/");
		setcookie("fashionuser_username", $fashionuser_username, time() - 3600*24*365,"/");
		echo "no";
	}
}

if(isset($_POST['logout']))
{
	setcookie("fashionuser_id", $fashionuser_id, time() - 3600*24*365,"/");
	setcookie("fashionuser_name", $fashionuser_name, time() - 3600*24*365,"/");
	setcookie("fashionuser_username", $fashionuser_username, time() - 3600*24*365,"/");
	echo "yes";
}

if(isset($_GET['logout']))
{
	setcookie("fashionuser_id", $fashionuser_id, time() - 3600*24*365,"/");
	setcookie("fashionuser_name", $fashionuser_name, time() - 3600*24*365,"/");
	setcookie("fashionuser_username", $fashionuser_username, time() - 3600*24*365,"/");
	header("Location: ../index.php");
}



?>