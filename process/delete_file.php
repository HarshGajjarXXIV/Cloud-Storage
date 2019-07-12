<?php

	session_start();
	if(isset($_SESSION['sdrive']))
	{
		$mail=$_SESSION['sdrive'];
		$md5mail=md5($mail);

		$fileID=$_POST['fid'];
		$fileNM=$_POST['fnm'];

		include '../include/connection.php';

		$qry="DELETE FROM sfiles WHERE fileid LIKE '$fileID'";
		$exe=mysqli_query($link,$qry);

		$filePath="../Storage/".$fileID."/".$fileNM."";
		$phpPath1="../Storage/".$fileID."/index.php";
		$phpPath2="../MyCloud/".$md5mail."/".$fileID."/index.php";
		$dirPath1="../Storage/".$fileID."";
		$dirPath2="../MyCloud/".$md5mail."/".$fileID."";

		unlink($filePath);
		unlink($phpPath1);
		unlink($phpPath2);
		rmdir($dirPath1);
		rmdir($dirPath2);

		header('Location: ../MyCloud/');
	}
	else
	{
		header('Location: ../');	
	}

?>