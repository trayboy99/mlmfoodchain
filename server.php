<?php 
	session_start();

	$username = "";
	$email 	  = "";
	$errors	  = array(); 

	$db = mysqli_connect('localhost', 'root', '', 'farewellhunger');

	if(isset($_POST['register'])) {
		$username   = mysqli_real_escape_string($db, $_POST['username']);
		$email 		= mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		if (empty($username)) {
			array_push($errors, "Password is required");
		}
		if (empty($email)) {
			array_push($errors, "Email is required");
		}
		if (empty($password_1)) {
			array_push($errors, "Password is required");
		}

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		if (count($errors) == 0) {
			$password = md5($password_1);
			$sql = "INSERT INTO user (username, email, password) 
						VALUES ('$username', '$email', '$password'),
							   ('$username', '$email', '$password'),
							   ('$username', '$email', '$password'),
							   ('$username', '$email', '$password'),
							   ('$username', '$email', '$password');";


			mysqli_multi_query($db, $sql);
			$_SESSION["username"] = $username;
			$_SESSION["success"] = "You are now logged in";
			header('location: dashboard.php');

		}

	}
?>