<?php
	include("../inc/connect.php");
	$db = new database();
	$conn = $db->connect();

		// initilize all variable
		$params = $columns = $totalRecords = $data = array();

		$params = $_REQUEST;

		//define index of column
		$columns = array( 
			/*array( 'db' => 'user_id', 'dt' => 0 ),
			array( 'db' => 'user_name',  'dt' => 1 ),
			array( 'db' => 'username',   'dt' => 2 ),*/
			0 =>'user_id',
			1 =>'user_name', 
			2 => 'username',
		);

		$where = $sqlTot = $sqlRec = "";

		// check search value exist
		if( !empty($params['search']['value']) ) {   
			$where .=" WHERE ";
			$where .=" ( user_name LIKE '".$params['search']['value']."%' ";    
			$where .=" OR user_username LIKE '".$params['search']['value']."%' ";
		}

		// getting total number records without any search
		$sql = "SELECT user_id,user_name,user_username FROM `user` ";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		//concatenate search sql if value exist
		if(isset($where) && $where != '') {

			$sqlTot .= $where;
			$sqlRec .= $where;
		}


	 	

	 	//$queryTot = $db->query($sqlTot)or die("database error:". mysqli_error());
		$queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));

	 	//$totalRecords = $db->rows($queryTot);
		$totalRecords = mysqli_num_rows($queryTot);

	 	//$queryRecords = $db->query($sqlRec) or die("error to fetch user data");
		$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");

		//iterate on results row and create new index array of data
		while( $row = mysqli_fetch_row($queryRecords) ) { 
			$data[] = $row;
		}	

		$json_data = array(
				"draw"            => intval( $params['draw'] ),   
				"recordsTotal"    => intval( $totalRecords ),  
				"recordsFiltered" => intval($totalRecords),
				"data"            => $data   // total data array
				);

		echo json_encode($json_data);  // send data as json format

?>
	