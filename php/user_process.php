<?php
	include("../inc/connect.php");
	$db = new database();
	$con = $db->connect();

	if(isset($_POST['add_user'])){
		$user_name = $_POST['user_name'];
		$user_email = $_POST['user_email'];
		$user_address = $_POST['user_address'];
		$user_province = $_POST['user_province'];
		$user_zipcode = $_POST['user_zipcode'];
		$user_tel = $_POST['user_tel'];
		$user_username = $_POST['user_username'];
		$user_password = $_POST['user_password'];
		$user_status = "user";

		if(isset($_POST['actionpage']))
		{
			$actionpage = $_POST['actionpage'];
		}

		$sql_user = "SELECT * FROM user WHERE user_username = '$user_username'";
		$query_user = $con->query($sql_user);
		$num_user = $query_user->num_rows;

		if($num_user == 0)
		{
			$sql = "INSERT INTO user";
			$sql .= "(user_name, user_email, user_address, user_province, ";
			$sql .= "user_zipcode, user_tel, user_username, user_password, user_status) ";
			$sql .="VALUES ";
			$sql .="('$user_name', '$user_email', '$user_address', '$user_province', ";
			$sql .="'$user_zipcode', '$user_tel', '$user_username', '$user_password', '$user_status')";
			$con->query($sql);
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
			echo "no";
		}		
	}

	if(isset($_POST['edit_user'])){
		$user_id = $_POST['user_id'];
		$user_name = $_POST['user_name'];
		$user_email = $_POST['user_email'];
		$user_address = $_POST['user_address'];
		$user_province = $_POST['user_province'];
		$user_zipcode = $_POST['user_zipcode'];
		$user_tel = $_POST['user_tel'];
		$user_password = $_POST['user_password'];

		$sql = "UPDATE user SET ";
		$sql .= "user_name = '$user_name', ";
		$sql .= "user_email = '$user_email', ";
		$sql .= "user_address = '$user_address', ";
		$sql .= "user_province = '$user_province', ";
		$sql .= "user_zipcode = '$user_zipcode', ";
		$sql .= "user_tel = '$user_tel', ";	
		$sql .= "user_password = '$user_password' ";
		$sql .= "WHERE user_id = '$user_id' ";
		$con->query($sql);

		echo "yes";
	}
?>