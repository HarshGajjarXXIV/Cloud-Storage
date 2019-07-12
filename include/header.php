<!-- Header -->
<div class='navbar navbar-default navbar-static-top'>
	<div class='container'>

		<div class="navbar-header">
			<?php 
				if($pageID==1)
				{
					echo "<a href='' class='navbar-brand'><i class='fa fa-cloud fa-lg'></i>&nbsp;Drive</a>";
				}
				else if($pageID==2)
				{
					echo "<a href='../../' class='navbar-brand'><i class='fa fa-cloud fa-lg'></i>&nbsp;Drive</a>";
				}
				else if($pageID==3)
				{
					echo "<a href='../' class='navbar-brand'><i class='fa fa-cloud fa-lg'></i>&nbsp;Drive</a>";
				}

			?>

			<button class='navbar-toggle' data-toggle='collapse' data-target='.navHeaderCollapse'>
					<i class="fa fa-bars"></i>
			</button>
		</div>

		<div class='collapse navbar-collapse navHeaderCollapse'>
			<ul class='nav navbar-nav navbar-right'>
			<?php if($pageID==1)
					{
						echo "<li><a href='#upload' data-toggle='modal'><i class='fa fa-cloud-upload fa-lg'></i>&nbsp;&nbsp;Upload File</a></li>";
						echo "<li class='active'><a href=''><i class='fa fa-cloud-download fa-lg'></i>&nbsp;&nbsp;My Cloud</a></li>";
						echo "<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-chevron-circle-down fa-lg'></i>&nbsp;&nbsp;More</a>
				 			<ul class='dropdown-menu'>
				 				<li><a href='profile/'><i class='fa fa-user fa-lg'></i>&nbsp;&nbsp;Profile</a></li>
				 				<li><a href='../process/logout.php'><i class='fa fa-sign-out fa-lg'></i>&nbsp;&nbsp;Logout</a></li>
				 			</ul>
				 			</li>";
					}
					else if($pageID==2)
					{
						if($log==1)
						{
							echo "<li><a href='../../../MyCloud'><i class='fa fa-cloud-download fa-lg'></i>&nbsp;&nbsp;My Cloud</a></li>
							<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-chevron-circle-down fa-lg'></i>&nbsp;&nbsp;More</a>
				 			<ul class='dropdown-menu'>
				 				<li><a href='../../profile/'><i class='fa fa-user fa-lg'></i>&nbsp;&nbsp;Profile</a></li>
				 				<li><a href='../../../process/logout.php'><i class='fa fa-sign-out fa-lg'></i>&nbsp;&nbsp;Logout</a></li>
				 			</ul>
				 			</li>";
				 		}
				 		else
				 		{
				 			echo "<li><a href='../../../accounts/'><i class='fa fa-sign-in fa-lg'></i>&nbsp;&nbsp;Login</a></li>";
				 		}
					}
					else if($pageID==3)
					{
						echo "<li><a href='../'><i class='fa fa-cloud-download fa-lg'></i>&nbsp;&nbsp;My Cloud</a></li>
							<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-chevron-circle-down fa-lg'></i>&nbsp;&nbsp;More</a>
				 			<ul class='dropdown-menu'>
				 				<li><a href=''><i class='fa fa-user fa-lg'></i>&nbsp;&nbsp;Profile</a></li>
				 				<li><a href='../../process/logout.php'><i class='fa fa-sign-out fa-lg'></i>&nbsp;&nbsp;Logout</a></li>
				 			</ul>
				 			</li>";
					}
					?>
			</ul>
		</div>

	</div>
</div>


<!-- Upload File -->
<div class="modal fade" id="upload" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4><b>Upload files</b></h4>
			</div>

			<div class="modal-body">
			<form enctype="multipart/form-data">			
				<input id="file_browser" name="uploadFile[]" type="file" class="file" multiple data-show-preview="false">
			</form>
			</div>

			<div class="modal-footer">
			<a class="btn btn-primary" data-dismiss="modal">Minimize</a>
			</div>
		</div>
	</div>
</div>