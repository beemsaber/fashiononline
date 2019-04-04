<?php
	error_reporting (E_ALL ^ E_NOTICE);
	include("../../inc/connect.php");
	$db = new database();
	$con = $db->connect();

	if(isset($_POST['add_product'])){
		$product_name = $_POST['product_name'];
		$cat_id = $_POST['cat_id'];
		$product_short_detail = $_POST['product_short_detail'];
		$product_full_detail = $_POST['product_full_detail'];
		$product_price = $_POST['product_price'];
		$product_qty = $_POST['product_qty'];
		$product_date = $_POST['datenow'];

		$sql = "INSERT INTO product";
		$sql .= "(product_name, cat_id, product_short_detail, product_full_detail, ";
		$sql .= "product_price, product_qty, product_date) ";
		$sql .="VALUES ";
		$sql .="('$product_name', '$cat_id', '$product_short_detail', '$product_full_detail', ";
		$sql .="'$product_price', '$product_qty', '$product_date')";
		$insert_query = $con->query($sql);
		if($insert_query)
		{
			echo "yes";
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $con->error;
		}
	}

	if(isset($_POST['edit_product'])){
		$product_id = $_POST['product_id'];
		$product_name = $_POST['product_name'];
		$cat_id = $_POST['cat_id'];
		$product_short_detail = $_POST['product_short_detail'];
		$product_full_detail = $_POST['product_full_detail'];
		$product_price = $_POST['product_price'];
		$product_qty = $_POST['product_qty'];
		$product_date = $_POST['datenow'];

		$sql = "UPDATE product SET ";
		$sql .= "product_name = '$product_name', ";
		$sql .= "cat_id = '$cat_id', ";
		$sql .= "product_short_detail = '$product_short_detail', ";
		$sql .= "product_full_detail = '$product_full_detail', ";
		$sql .= "product_price = '$product_price', ";
		$sql .= "product_qty = '$product_qty', ";
		$sql .= "product_date = '$product_date' ";
		$sql .= "WHERE product_id = '$product_id' ";
		$con->query($sql);

		echo "yes";
	}

	if(isset($_POST['delete_product'])){
		$product_id = $_POST['product_id'];

		$sql_product = "SELECT * FROM product WHERE product_id = '$product_id'";
		$q_product = $con->query($sql_product);
		$r_product = $q_product->fetch_object();

		$product_date = $r_product->product_date;

		$sql_image = "SELECT * FROM image WHERE image_date = '$product_date'";
        $q_image = $con->query($sql_image);
        while($r_image = $q_image->fetch_object())
        {
        	$image_name = $r_image->image_name;
			$image = '../../images/product/' . $image_name;
			if(file_exists($image))	// file_exists คือฟังก์ชัน เช็คว่าไฟล์หรือ directory มีอยู่หรือไม่
			{unlink($image);}
        }

		$sql = "DELETE FROM product WHERE product_id = '$product_id'";
		$con->query($sql);

		$del_image = "DELETE FROM image WHERE image_date = '$product_date'";
		$con->query($del_image);

		echo "yes";
	}

	if(isset($_POST['delete_image'])){
		$image_id = $_POST['image_id'];

		$sql_image = "SELECT * FROM image WHERE image_id = '$image_id'";
        $q_image = $con->query($sql_image);

        while($r_image = $q_image->fetch_object())
        {
        	$image_name = $r_image->image_name;
			$image = '../../images/product/' . $image_name;
			if(file_exists($image))	// file_exists คือฟังก์ชัน เช็คว่าไฟล์หรือ directory มีอยู่หรือไม่
			{unlink($image);}
        }

		$del_image = "DELETE FROM image WHERE image_id = '$image_id'";
		$con->query($del_image);

		echo "yes";
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