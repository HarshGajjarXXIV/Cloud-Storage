<?php

	session_start();
	if(!isset($_SESSION['sdrive']))
	{
		exit();
	}
	else
	{
		$mail=($_SESSION['sdrive']);

		include '../include/connection.php';
		
		$qry="SELECT * FROM sfiles WHERE suser LIKE '$mail' ORDER BY filenm ASC";
		$exe=mysqli_query($link,$qry);
		if ($exe->num_rows > 0)
		{
			echo "<table class='table'>
				<thead>
				<th colspan=3><h4><strong><center>My Files&nbsp;<i class='fa fa-file'></center></strong><h4></th>
				</thead>
				<tbody>";

			while ($arr = $exe->fetch_assoc())
			{
				$length=strlen($arr['filenm']);

				if($length>50)
				{
					$tmpNm=substr($arr['filenm'],0,50);
					echo "<tr>";
					echo "<td><b>".$tmpNm."...</b></td>";
				}
				else
				{
					echo "<tr>";
					echo "<td><b>".$arr['filenm']."</b></td>";
				}

				echo "<td align='right'><a href='".$arr['pagepth']."'><button class='btn btn-primary btn-sm'><i class='fa fa-file'></button></a></td>";
				echo "<td align='right'><a href='".$arr['filepth']."'><button class='btn btn-success btn-sm'><i class='fa fa-download'></button></td>";
				echo "</tr>";
			}

			echo "</tbody>
			</table>";
		}
		else
		{
			echo "<center><h4><strong>No file to display</strong></h3></center>";
		}
	}

?>