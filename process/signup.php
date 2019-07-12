<?php

	if(isset($_POST['signup'])) {

		include '../include/connection.php';

		$fnm=mysqli_real_escape_string($link, $_POST['fname']);
		$lnm=mysqli_real_escape_string($link, $_POST['lname']);
		$mail=$_POST['mail'];
		$pass=md5($_POST['pass']);
		$cpass=md5($_POST['cpass']);
		$passlen=strlen($pass);

		if(preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$mail)) { 

			if($pass==$cpass) {

				$qry="INSERT INTO suser(fnm, lnm, mail, pw) VALUES ('$fnm','$lnm','$mail','$pass');";
				$exe=mysqli_query($link,$qry);

				if($exe==1) {

					session_start();
					$_SESSION['sdrive'] = $mail;
					$md5mail=md5($mail);
					$dir="../MyCloud/".$md5mail."";
					mkdir($dir);

					$my_file=$dir.'/index.php';
					$handle=fopen($my_file, 'w');
					$data = "<?php header('Location: ../../') ?>";
					fwrite($handle, $data);
					
					header('Location: ../MyCloud/');
				} else {
					$msg = "This email id is already registered!!";
					header('Location: ../signup/index.php?error='.$msg);
				}
			} else {
				$msg = "Password and Confirm Password does not match!!";
				header('Location: ../signup/index.php?error='.$msg);
			}
		} else {
			$msg = "Invalid E-mail Address!!";
			header('Location: ../signup/index.php?error='.$msg);
		}
	} else {
		header('Location: ../');
	}
?>