<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include("../inc/connect.php");
	$db = new database();
	$con = $db->connect();

	if(isset($_POST['user_order'])){
		$order_id = date('ymdhis');
		$total_price = $_POST['total_price'];
		$type_delivery = $_POST['type_delivery'];
		$money_delivery = $_POST['money_delivery'];
		$grand_total_price = $_POST['grand_total_price'];
		$order_date = date('Y-m-d H:i:s');
		$user_id = $_POST['user_id'];

		$sql_order  = "INSERT INTO order_main";
		$sql_order .= "(order_id, total_price, type_delivery, money_delivery, ";
		$sql_order .= "grand_total_price, order_date, user_id, order_status)";
		$sql_order .= "VALUES ";
		$sql_order .= "('$order_id', '$total_price', '$type_delivery', '$money_delivery', ";
		$sql_order .= "'$grand_total_price', '$order_date', '$user_id', 'รอชำระเงิน')";
		$query_order_main = $con->query($sql_order) or die(mysqli_error($con) . "<br>$sql_order");

		foreach($_SESSION['cart'] as $product_id=>$qty)
		{
			$sql_product = "select * from product where product_id = '$product_id'";
			$query_product = $con->query($sql_product);
			$result_product = $query_product->fetch_object();
			$sum = $result_product->product_price * $qty;
			
			$sql_order_detail  = "INSERT INTO order_detail";
			$sql_order_detail .= "(order_id, product_id, product_qty, sum_price)";
			$sql_order_detail .= "VALUES ";
			$sql_order_detail .= "('$order_id', '$product_id', '$qty', '$sum')";
			$query_order_detail = $con->query($sql_order_detail) or die(mysqli_error($con) . "<br>$sql_order_detail");
		}

		if($query_order_main && $query_order_detail)
		{
			foreach($_SESSION['cart'] as $product_id=>$qty)
			{
				unset($_SESSION['cart']);
			}			
			echo "yes";
		}
		else
		{
			echo "no";
		}
	}

	if(isset($_POST['add_payment'])){
		$p_bank = $_POST['p_bank'];
		$p_date = DateConvert($_POST['p_date']);
		$p_time = $_POST['p_time'];
		$p_price = $_POST['p_price'];
		$p_datenow = $_POST['datenow'];
		$order_id = $_POST['order_id'];
		$order_status = "ชำระเงินแล้ว";

		$sql_payment  = "INSERT INTO payment";
		$sql_payment .= "(p_bank, p_date, p_time, p_price, p_datenow)";
		$sql_payment .= "VALUES ";
		$sql_payment .= "('$p_bank', '$p_date', '$p_time', '$p_price', '$p_datenow') ";
		$query_payment = $con->query($sql_payment) or die(mysqli_error($con) . "<br>$sql_payment");

		//$sql_order_main = "UPDATE order_main SET order_status = 'ชำระเงินแล้ว', payment_date = '2018-03-15 11:36:57' WHERE order_id = '1803240932'";
		$sql_order_main = "UPDATE order_main SET ";
		$sql_order_main .= "order_status = '$order_status', ";
		$sql_order_main .= "payment_date = '$p_datenow' ";
		$sql_order_main .= "WHERE order_id = '$order_id' ";
		$query_order_main = $con->query($sql_order_main) or die(mysqli_error($con) . "$sql_order_main");

		$sql_order_stock = "SELECT * FROM order_detail WHERE order_id = '$order_id'";
		$query_order_stock = $con->query($sql_order_stock);
		while($r_order_stock = $query_order_stock->fetch_object())
		{
			$num_product_order = $r_order_stock->product_qty;
			
			$product_id = $r_order_stock->product_id;
			$sql_stock = "SELECT * FROM product WHERE product_id = '$product_id'";
			$query_stock = $con->query($sql_stock);
			$result_stock = $query_stock->fetch_object();

			$num_product_stock = $result_stock->product_qty;
			$total_stock = $num_product_stock - $num_product_order;

			$sql_update_stock = "UPDATE product SET ";
			$sql_update_stock .= "product_qty = '$total_stock' ";
			$sql_update_stock .= "WHERE product_id = '$product_id' ";
			$con->query($sql_update_stock);
		}

		if($query_payment && $query_order_main)
		{
			echo "yes";
		}
		else
		{
			echo "no";
		}
	}

	if(isset($_POST['image_main'])){
		$image_name = $_POST['image_name'];
		$image_date = $_POST['image_date'];

		$sql = "INSERT INTO image";
		$sql .= "(image_name, image_date) ";
		$sql .="VALUES ";
		$sql .="('$image_name', '$image_date')";
		$con->query($sql);
		echo "yes";
	}
	
?>