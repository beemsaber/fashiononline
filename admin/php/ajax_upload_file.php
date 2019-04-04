<?php
	error_reporting (E_ALL ^ E_NOTICE);
    include('class.fileuploader.php');

    if (isset($_POST['image_main'])) {
	    $FileUploader = new FileUploader('image_main', array(
	        'uploadDir' => '../../images/product/',
	        'title' => 'auto',
	    ));
		
		// call to upload the files
	    $data = $FileUploader->upload();

		// export to js
		echo json_encode($data);
		exit;
	}
?>