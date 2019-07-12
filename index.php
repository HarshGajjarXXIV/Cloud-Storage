<?php
	session_start();
	if(isset($_SESSION['sdrive']))
	{
		header("Location: MyCloud/");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name='viewport' content='width=device-width' initial-scale='1.0'>
	<title>Login | Drive</title>
   
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/web_style.css">
	<link rel="stylesheet" href="assets/font/css/font-roboto.css">
	<link rel="stylesheet" href="assets/font/css/font-awesome.min.css">

	<link rel="icon" href="assets/ico/favicon.ico" type="image/x-icon"/>

</head>
<body>

	<div class="container" style="margin-top: 150px">
		
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<?php
					if(isset($_GET['error'])) {
						echo '<center style="margin-bottom: 20px;"><strong><font color="red">'.$_GET['error'].'</font></strong></center>';
					}
				?>
				<div class="panel panel-default">
                    <div class="panel-heading"><h4><center>Login To Drive</center></h4></div>
                        <div class="panel-body">
						<form action="process/login.php" method="post" style="margin-top: 20px" >
							<div class="form-group">
	                        	<input type="email" name="mail" placeholder="Email..." id="lmail" class="form-control" required>
	                        </div>
	                        <div class="form-group">
	                        	<input type="password" name="pass" placeholder="Password..." id="lpass" class="form-control" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-success btn-block"><strong>Login</strong></button>
					</form>
				</div>
				
			</div>
			<center><b>Don't have an account? <a href="signup/">Get One</a></b></center>
			<div class="col-md-4"></div>
		</div>

	</div>


	<script src="assets/js/jquery-3.1.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>

</body>
</html>