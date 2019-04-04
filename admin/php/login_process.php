<?php
error_reporting (E_ALL ^ E_NOTICE);
include("../../inc/connect.php");
$db = new database();
$con = $db->connect();

if(isset($_POST['login']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$remember_check = $_POST['remember_check'];
	
	$sql = "SELECT * FROM user WHERE user_username = '$username'";
	$sql .= " AND user_password = '$password' AND user_status = 'admin' ";
	$query_user = $con->query($sql);
	$num_user = $query_user->num_rows;

	if($num_user > 0)
	{
		$result_user = $query_user->fetch_object();
		$a_id = $result_user->user_id;
		$a_name = $result_user->user_name;
		$a_username = $result_user->user_username;

		if($remember_check == "true")
		{
			setcookie("a_id", $a_id, time() + 3600*24*365,"/");
			setcookie("a_name", $a_name, time() + 3600*24*365,"/");
			setcookie("a_username", $a_username, time() + 3600*24*365,"/");
			echo "yes";
		}
		else
		{
			setcookie("a_id", $a_id, time() + 3600,"/");
			setcookie("a_name", $a_name, time() + 3600,"/");
			setcookie("a_username", $a_username, time() + 3600,"/");
			echo "yes";
		}
	}
	else
	{
		setcookie("a_id", $a_id, time() - 3600*24*365,"/");
		setcookie("a_name", $a_name, time() - 3600*24*365,"/");
		setcookie("a_username", $a_username, time() - 3600*24*365,"/");
		echo "no";
	}
}

if(isset($_POST['logout']))
{
	setcookie("a_id", $a_id, time() - 3600*24*365,"/");
	setcookie("a_name", $a_name, time() - 3600*24*365,"/");
	setcookie("a_username", $a_username, time() - 3600*24*365,"/");
	echo "yes";
}



?>