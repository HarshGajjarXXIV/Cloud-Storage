<?php

	$arrFiles=count(isset($_FILES['uploadFile']['name'])?$_FILES['uploadFile']['name']:0);

	session_start();

	$mail=$_SESSION['sdrive'];

	$success = null;

	for($i = 0; $i < $arrFiles; $i++)
	{
	

		$fileName=$_FILES['uploadFile']['name'][$i];
		$tmpName=$_FILES['uploadFile']['tmp_name'][$i];
		$fileSizeB=$_FILES["uploadFile"]["size"][$i];

		$fileSizeK=$fileSizeB / 1024;
		$fileSizeM=$fileSizeK / 1024;

		$fileSize=round($fileSizeM, 2);

		$path_parts = pathinfo($_FILES["uploadFile"]["name"][$i]);
		$fileExt = $path_parts['extension'];

		$md5mail=md5($mail);

		$uniq=uniqid();

		$fid=md5($mail.$fileName.$uniq);

		$filePath="../Storage/".$fid."/".$fileName;
		$filedir="../Storage/".$fid."";
		mkdir($filedir);

		$empty_file=$filedir.'/index.php';
		$handle_emptyfile=fopen($empty_file, 'w');
		$empty_data= '<?php header("Location: ../../"); ?>';
		fwrite($handle_emptyfile, $empty_data);

		if(move_uploaded_file($tmpName,$filePath))
		{

			$phpdir="../MyCloud/".$md5mail."/".$fid."";
			mkdir($phpdir);

			$pagePath=$md5mail."/".$fid."/";

			$my_file=$phpdir.'/index.php';
			$handle=fopen($my_file, 'w');

			$data = '
			<?php

				session_start();
				if(isset($_SESSION["sdrive"]))
				{
					$log=1;
					$mail=$_SESSION["sdrive"];
				}
				else
				{
					$log=0;
				}
				$pageID=2;
				$fid="'.$fid.'";
				$fnm="'.$fileName.'"

			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta name="viewport" content="width=device-width" initial-scale="1.0">
				<title><?php echo $fnm."| Drive"; ?></title>
				<link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
				<link rel="stylesheet" href="../../../assets/css/web_style.css">
				<link rel="stylesheet" href="../../../assets/font/css/font-roboto.css">
				<link rel="stylesheet" href="../../../assets/font/css/font-awesome.min.css">

				<link rel="icon" href="../../../assets/ico/favicon.ico" type="image/x-icon"/>
			</head>

			<body>

			<?php include "../../../include/header.php"; ?>

			<div class="container">
			<br>
			<div class="panel panel-default">
			
				
			<?php

				include "../../../include/connection.php";
				$qry="SELECT * FROM sfiles WHERE fileid LIKE \'$fid\'";
				$exe=mysqli_query($link,$qry);

				$arr=mysqli_fetch_array($exe);

				if(isset($mail))
				{
					if($mail==$arr[4])
					{
						$own=1;
					}
					else
					{
						$own=0;
						$share=$arr[7];
					}	
				}
				else
				{
					$own=0;
					$share=$arr[7];
				}

				if($own==0 && $share==0) {
					header(\'Location: ../../../\');	
				}
						
			
			echo "<table class=\'table\'>
					<thead>
						<th><h4><strong><center>".$arr[1]."</center></strong></h4></th>
					</thead>
					<tbody>
						<tr>
							<td><center><B>File type</B> ".$arr[2]."</center></td>
						</tr>
						<tr>
							<td><center><B>File size</B> ".$arr[3]."MB</center></td>
						</tr>";
						if($own==1)
						{
							if($arr[7]==0)
							{
							echo "<tr>
									<td><center><B>Sharing</B> Off</center></td>
								</tr>";
							}
							else if($arr[7]==1)
							{
								echo "<tr>
									<td><center><B>Sharing</B> On</center></td>
								</tr>";
							}
						}
					echo"<tr>
							<td><center><B>Upload date</B> ".$arr[8]."</center></td>
						</tr>
						<tr>
							<td><center>
							<form method=\'post\' action=\'../../../process/download.php\'>
							<input type=\'hidden\' value=".$arr[0]." name=\'file\'> 
							<button type=\'submit\' class=\'btn btn-primary btn-sm\'>Download</button> 
						</tr>";
					if($own==1)
					{	
						echo "<tr>
							<td><center><a href=\'#delete\' data-toggle=\'modal\'><button class=\'btn btn-danger btn-sm\'>Delete</button></a> <a href=\'#share\' data-toggle=\'modal\'><button class=\'btn btn-success btn-sm\'>Share</button></a></center></td>
						</tr>";
					}
					echo "</tbody>
				  </table>";

			?>
				

				</div>
				</div>

			</body>

				<script src="../../../assets/js/jquery-3.1.0.min.js"></script>
				<script src="../../../assets/js/bootstrap.min.js"></script>
				
			</html>

			<!-- Delete Dialog -->
			<div class="modal fade" id="delete" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">

						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4><b>Want to delete this file?</b></h4>
						</div>

						<div class="modal-body">
							<center>Are you sure you want to delete this file? This step can\'t be undo!</center>
						</div>

						<div class="modal-footer">
							
							<?php
								echo "<form action=\'../../../process/delete_file.php\' method=\'POST\'>";
								echo "<input type=hidden name=fid value=\'".$arr[0]."\'>";
								echo "<input type=hidden name=fnm value=\'".$arr[1]."\'>";
								echo"<center><button type=submit class=\'btn btn-danger btn-sm\'>Delete</button></center>"; 
								echo "</form>"; 
							?>

						</div>
					</div>
				</div>
			</div>

			<!-- Share Dialog -->
			<div class="modal fade" id="share" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">

						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4><b>Want to share this file?</b></h4>
						</div>

						<div class="modal-body">		
						<center>To share this file, turn on sharing, copy the link from url and paste it in an email or anywhere you want to share it!</center>
						</div>

						<div class="modal-footer">
						<?php
								echo "<form action=\'../../../process/share_file.php\' method=\'POST\'>";
								echo "<input type=hidden name=fid value=\'".$arr[0]."\'>";
								echo "<input type=hidden name=fshr value=\'".$arr[7]."\'>";
								if($arr[7]==0)
								{
								echo"<center><button type=submit class=\'btn btn-success btn-sm\'>Share</button></center>"; 
								}
								else if($arr[7]==1)
								{
								echo"<center><button type=submit class=\'btn btn-danger btn-sm\'>Stop Sharing</button></center>"; 
								}
								echo "</form>"; 
							?>
						</div>

					</div>
				</div>
			</div>';

			fwrite($handle, $data);

			include '../include/connection.php';

			$qry="INSERT INTO sfiles(fileid, filenm, fileext, filesize, suser, filepth, pagepth, fileshare) VALUES ('$fid','$fileName','$fileExt','$fileSize','$mail','$filePath','$pagePath',0);";
			mysqli_query($link,$qry);
		}

	}
	
	//$output=['error'=>'No files were processed.'];
	$output=[];
	
	echo json_encode($output);

?>