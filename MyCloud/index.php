<?php

	session_start();
	if(!isset($_SESSION['sdrive']))
	{
		header("Location: ../");
	}
	
	$mail=$_SESSION['sdrive'];
	$pageID=1;
	$log=1;
?>


<!DOCTYPE html>
  <head>
    <meta name='viewport' content='width=device-width' initial-scale='1.0'>
    <title>My Cloud | Drive</title>
        
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/web_style.css">
    	<link rel="stylesheet" href="../assets/css/fileinput.min.css">
		<link rel="stylesheet" href="../assets/font/css/font-roboto.css">
		<link rel="stylesheet" href="../assets/font/css/font-awesome.min.css">

		<link rel="icon" href="../assets/ico/favicon.ico" type="image/x-icon"/>

	</head>

	<body>

	<?php include '../include/header.php'; ?>
		
		<div class="container">
		<br>
		<div class="panel panel-default">
		<div id="show"></div>
		</div>

		</div>

	</body>

	<script src="../assets/js/jquery-3.1.0.min.js"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/js/fileinput.min.js" type="text/javascript"></script>
   	<script>

	$("#file_browser").fileinput({
		uploadUrl: "../process/upload_process.php",
		uploadAsync: false,
		minFileCount: 1,
	    maxFileCount: 20,
	    maxFileSize: 10737418240,
	    showRemove: true,
	    showCancel: true,
	});

	</script>
	<script>

		$(document).ready(function() {
			setInterval(function () {
				$('#show').load('../process/load_files.php')
			}, 1500);
		});

	</script>

</html>