<?php
	error_reporting (E_ALL ^ E_NOTICE);
	include("../../inc/connect.php");
	$db = new database();
	$con = $db->connect();

	if(isset($_POST['delete_order'])){
		$order_id = $_POST['order_id'];
		$payment_date = $_POST['payment_date'];
		
		$del_order_main = "DELETE FROM order_main WHERE order_id = '$order_id'";
		$con->query($del_order_main) or die(mysqli_error($con) . "<br>$del_order_main");

		$del_order_detail = "DELETE FROM order_detail WHERE order_id = '$order_id'";
		$con->query($del_order_detail) or die(mysqli_error($con) . "<br>$del_order_detail");

		if($payment_date != 0)
		{
			$del_payment = "DELETE FROM payment WHERE p_datenow = '$payment_date'";
			$con->query($del_payment) or die(mysqli_error($con) . "<br>$del_payment");

			$sql_image = "SELECT * FROM image WHERE image_date = '$payment_date'";
			$query_image = $con->query($sql_image);
			$result_image = $query_image->fetch_object();
			$image_name = $result_image->image_name;

			$del_image = "DELETE FROM image WHERE image_name = '".$image_name."' ";
			$con->query($del_image);
			$files = '../../images/payment/' . $image_name;
		    if(file_exists($files))	// image_exists คือฟังก์ชัน เช็คว่าไฟล์หรือ directory มีอยู่หรือไม่
				{unlink($files);}
		}

		echo "yes";
	}	
?>