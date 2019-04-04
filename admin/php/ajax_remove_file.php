<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../../inc/connect.php');
$db = new database();
$con = $db->connect();

if (isset($_POST['image_main'])) {
    $files = '../../images/product/' . $_POST['image_name'];

	$image_name = $_POST['image_name'];
	$del_image = "DELETE FROM image WHERE image_name = '".$image_name."' ";
	$con->query($del_image);

    if(file_exists($files))	// image_exists คือฟังก์ชัน เช็คว่าไฟล์หรือ directory มีอยู่หรือไม่
		{unlink($files);}

	echo "yes";
}

?>

