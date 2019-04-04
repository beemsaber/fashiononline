<?php
session_start();
	
	$product_id = $_GET['product_id']; 
	$action = $_GET['action'];
	$product_qty = $_GET['product_qty'];
	$quantity = $_GET['quantity'];
 
	if($action=='add' && !empty($product_id))
	{
		if(isset($_SESSION['cart'][$product_id]))
		{
			$_SESSION['cart'][$product_id]++;
		}
		else
		{
			$_SESSION['cart'][$product_id]=$product_qty;
		}
	}

	if($action=='addfrom_product_detail')
	{
		if(isset($_SESSION['cart'][$product_id]))
		{
			$_SESSION['cart'][$product_id]+=$quantity;
		}
		else
		{
			$_SESSION['cart'][$product_id]=$quantity;
		}
	}
 
	if($action=='remove' && !empty($product_id))  //ยกเลิกการสั่งซื้อ
	{
		unset($_SESSION['cart'][$product_id]);
	}
 
	if($action=='update')
	{
		$amount_array = $_POST['amount'];
		foreach($amount_array as $product_id=>$amount)
		{
			$_SESSION['cart'][$product_id]=$amount;
		}
	}
	
	
header("location:../cart.php");
?>