<?php
	
	if(isset($_POST['login'])) {
		include '../include/connection.php';

		$mail=$_POST['mail'];
		$pass=md5($_POST['pass']);
			
		$qry="SELECT * FROM suser WHERE mail LIKE '$mail'";
		$exe=mysqli_query($link,$qry);

		$arr=mysqli_fetch_array($exe);
			

		if($arr[3]==$pass)
		{
			session_start();
			$_SESSION['sdrive'] = $mail;
			header('Location: ../MyCloud/');
		}
		else
		{
			$msg = "Email or Password is incorrect!!";
			header('Location: ../index.php?error='.$msg);
		}
	} else{
		header('Location: ../');
	}
	
?>