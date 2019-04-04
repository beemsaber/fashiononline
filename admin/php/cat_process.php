<?php
	error_reporting (E_ALL ^ E_NOTICE);
	include("../../inc/connect.php");
	$db = new database();
	$con = $db->connect();

	if(isset($_POST['add_cat'])){
		$cat_name = $_POST['cat_name'];

		$sql = "INSERT INTO categories";
		$sql .= "(cat_name) ";
		$sql .="VALUES ";
		$sql .="('$cat_name')";
		$con->query($sql);
		echo "yes";
	}

	if(isset($_POST['edit_cat'])){
		$cat_id = $_POST['cat_id'];
		$cat_name = $_POST['cat_name'];

		$sql = "UPDATE categories SET ";
		$sql .= "cat_name = '$cat_name' ";
		$sql .= "WHERE cat_id = '$cat_id' ";
		$con->query($sql);

		echo "yes";
	}

	if(isset($_POST['delete_cat'])){
		$cat_id = $_POST['cat_id'];

		$sql = "DELETE FROM categories WHERE cat_id = '$cat_id'";
		$con->query($sql);

		echo "yes";
	}
?>