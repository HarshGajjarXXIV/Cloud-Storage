<?php
	
	if(isset($_POST['file'])) {

		$id = $_POST['file'];
		include '../include/connection.php';

		$qry="SELECT * FROM sfiles WHERE fileid LIKE '$id'";
		$exe=mysqli_query($link,$qry);

		$arr=mysqli_fetch_array($exe);

		$fileName = $arr[1];
		$filePath = $arr[5];

		header('Content-Disposition: attachment; filename='.$fileName.''); 
	    ob_clean();

	    readfile($filePath);

	} else {
		
		header('Location: ../');
	}

?>