<?php

	session_start();
	if(!isset($_SESSION['sdrive']))
	{
		header("Location: ../../");
	}
	$pageID=3;
	$user=$_SESSION['sdrive'];

?>

<!DOCTYPE html>
  <head>
    <meta name='viewport' content='width=device-width' initial-scale='1.0'>
    <title>Profile | Drive</title>
        
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../assets/css/web_style.css">
		<link rel="stylesheet" href="../../assets/font/css/font-roboto.css">
		<link rel="stylesheet" href="../../assets/font/css/font-awesome.min.css">

		<link rel="icon" href="../../assets/ico/favicon.ico" type="image/x-icon"/>

	</head>

	<body>

	<?php include '../../include/header.php'; ?>
		
		<div class="container">
		<br>
		<div class="panel panel-default">

		<?php include '../../include/connection.php';

		$qry="SELECT * FROM suser WHERE mail LIKE '$user'";
		$exe=mysqli_query($link,$qry);

		$arr=mysqli_fetch_array($exe);

		echo "<table class='table'>
		<thead>
			<th><h4><strong><center>".$arr[0]." ".$arr[1]."</center></strong></h4></th>
		</thead>
		<tbody>
			<tr>
				<td><center><B>User Email</B> ".$arr[2]."</center></td>
			</tr>";
		?>

		<?php 

			$qry2="SELECT * FROM sfiles WHERE suser LIKE '$user'";
			$exe2=mysqli_query($link,$qry2);
			if ($exe2->num_rows > 0)
			{
				$fnum=0;
				$fsize=0;
				$fshare=0;
				while ($arr2 = $exe2->fetch_assoc())
				{
					$fnum=$fnum + 1;
					$fsize=$fsize + $arr2['filesize'];

					if($arr2['fileshare']==1)
					{
						$fshare=$fshare + 1;
					}
					
				}
				$fsizetmp=$fsize / 1024;
				$fsizeg=round($fsizetmp, 2);
				echo "<tr>
						<td><center><B>Uploaded files</B> ".$fnum."</center></td>
						</tr>";
				echo "<tr>
						<td><center><B>Shared files</B> ".$fshare."</center></td>
						</tr>";
				echo "<tr>
						<td><center><B>Used memory(MB)</B> ".$fsize."MB</center></td>
						</tr>";
				echo "<tr>
						<td><center><B>Used memory(GB)</B> ".$fsizeg."GB</center></td>
						</tr>";
			}
			else
			{
				echo "<tr>
						<td><center><B>Uploaded files</B> 0</center></td>
						</tr>";
				echo "<tr>
						<td><center><B>Shared files</B> 0</center></td>
						</tr>";
				echo "<tr>
						<td><center><B>Used memory(MB)</B> 0MB</center></td>
						</tr>";
				echo "<tr>
						<td><center><B>Used memory(GB)</B> 0GB</center></td>
						</tr>";
			}

		?>

		</tbody>
	  </table>


		</div>
		</div>

	</body>

	<script src="../../assets/js/jquery-3.1.0.min.js"></script>
	<script src="../../assets/js/bootstrap.min.js" type="text/javascript"></script>

</html>