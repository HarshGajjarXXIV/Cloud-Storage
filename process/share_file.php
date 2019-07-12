<?php
	
	session_start();
	if(isset($_SESSION['sdrive']))
	{

		$fileID=$_POST['fid'];
		$fileShr=$_POST['fshr'];

		include '../include/connection.php';

		if($fileShr==0)
		{
			$qry="UPDATE sfiles SET fileshare=1 WHERE fileid LIKE '$fileID'";
		}
		else if($fileShr==1)
		{
			$qry="UPDATE sfiles SET fileshare=0 WHERE fileid LIKE '$fileID'";
		}

		$exe=mysqli_query($link,$qry);

		echo "<script>
					window.history.back();
			</script>";
		
	}
	else
	{
		header('Location: ../');
	}


?>