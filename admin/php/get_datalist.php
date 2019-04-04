<?php
	error_reporting (E_ALL ^ E_NOTICE);
	include("../../inc/connect.php");
	//ตรวจสอบว่า มีค่า ตัวแปร $_GET['show_dept'] เข้ามาหรือไม่ 
	if(isset($_GET['show_province'])){
		
		//คำสั่ง SQL เลือก dept
		$sql = "SELECT * FROM province ORDER BY province_id";
		
		//ประมวณผลคำสั่ง SQL
		$db = new database();
		$con = $db->connect();
		$query = $con->query($sql);

		//ตรวจสอบ จำนวนข้อมูลที่ได้ มีค่ามากกว่า  0 หรือไม่
		if ($query->num_rows > 0) {
			
			//วนลูปแสดงข้อมูลที่ได้ เก็บไว้ในตัวแปร $result
			while($result = $query->fetch_assoc()) {
				
				//เก็บข้อมูลที่ได้ไว้ในตัวแปร Array 
				$json_result[] = [
					'province_id'=>$result['province_id'],
					'province_name'=>$result['province_name'],
				];
			}
			
			//ใช้ Function json_encode แปลงข้อมูลในตัวแปร $json_result ให้เป็นรูปแบบ Json
			echo json_encode($json_result);
			
		} 
	}

	if(isset($_GET['show_cat'])){
		
		//คำสั่ง SQL เลือก dept
		$sql = "SELECT * FROM categories ORDER BY cat_id";
		
		//ประมวณผลคำสั่ง SQL
		$db = new database();
		$con = $db->connect();
		$query = $con->query($sql);

		//ตรวจสอบ จำนวนข้อมูลที่ได้ มีค่ามากกว่า  0 หรือไม่
		if ($query->num_rows > 0) {
			
			//วนลูปแสดงข้อมูลที่ได้ เก็บไว้ในตัวแปร $result
			while($result = $query->fetch_assoc()) {
				
				//เก็บข้อมูลที่ได้ไว้ในตัวแปร Array 
				$json_result[] = [
					'cat_id'=>$result['cat_id'],
					'cat_name'=>$result['cat_name'],
				];
			}
			
			//ใช้ Function json_encode แปลงข้อมูลในตัวแปร $json_result ให้เป็นรูปแบบ Json
			echo json_encode($json_result);
			
		} 
	}

	if(isset($_GET['show_fish'])){
		
		//คำสั่ง SQL เลือก dept
		$sql = "SELECT * FROM fish ORDER BY fish_id";
		
		//ประมวณผลคำสั่ง SQL
		$db = new database();
		$con = $db->connect();
		$query = $con->query($sql);

		//ตรวจสอบ จำนวนข้อมูลที่ได้ มีค่ามากกว่า  0 หรือไม่
		if ($query->num_rows > 0) {
			
			//วนลูปแสดงข้อมูลที่ได้ เก็บไว้ในตัวแปร $result
			while($result = $query->fetch_assoc()) {
				
				//เก็บข้อมูลที่ได้ไว้ในตัวแปร Array 
				$json_result[] = [
					'fish_id'=>$result['fish_id'],
					'fish_name'=>$result['fish_name'],
				];
			}
			
			//ใช้ Function json_encode แปลงข้อมูลในตัวแปร $json_result ให้เป็นรูปแบบ Json
			echo json_encode($json_result);
			
		} 
	}
	
?>