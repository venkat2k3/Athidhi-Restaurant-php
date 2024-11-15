<?php

$server = "localhost";
$username = "root";
$password = "";
$db_name = "user_data";
session_start();
$conc = mysqli_connect($server , $username , $password , $db_name);

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $button = $_POST['submit'];
  if($button == 'Submit'){
    $email = $_POST['useremail'];
    $password = $_POST['password'];
    $query = "SELECT * FROM userdetails WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conc , $query);
    
    if(mysqli_num_rows($result) > 0){
		$_SESSION['user_email'] = $email;
      header("Location: Home.php");
      exit();
    }
    else{
      $error = urldecode("Useremail or password is incorrect");
      header("Location: Login.php?error=$error");
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Page</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
	<style>
		body {
			margin: 0;
			font-family: 'Roboto', sans-serif;
			background-image: url('background-image.jpg');
			background-size: cover;
			background-position: center;
			color: #333;
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.container-fluid {
			width: 100%;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.main-content {
			width: 100%;
			border-radius: 20px;
			box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
			display: flex;
			background: rgba(255, 255, 255, 0.9);
			overflow: hidden;
		}

		.company__info {
			background-color: #008080;
			color: #fff;
			padding: 2em;
			flex: 1;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}

		.company__info h2 {
			font-size: 3em;
			margin: 0;
		}

		.company__info h4 {
			margin-top: 1em;
		}

		.login_form {
			padding: 2em;
			flex: 2;
		}

		.login_form h2 {
			color: #008080;
			margin-bottom: 1em;
		}

		.form__input {
			width: 100%;
			border: none;
			border-bottom: 2px solid #ccc;
			padding: 1em 0.5em 0.5em;
			font-size: 1em;
			outline: none;
			transition: all 0.3s ease;
		}

		.form__input:focus {
			border-bottom-color: #008080;
			box-shadow: 0 0 5px rgba(0, 128, 128, 0.5);
		}

		.btn {
			width: 100%;
			padding: 0.8em;
			margin-top: 1em;
			border: none;
			border-radius: 30px;
			background-color: #008080;
			color: #fff;
			font-weight: bold;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		.btn:hover {
			background-color: #005a5a;
		}

		.row p {
			margin-top: 1em;
		}

		.row p a {
			color: #008080;
			text-decoration: none;
		}

		.row p a:hover {
			text-decoration: underline;
		}

		@media screen and (max-width: 768px) {
			.main-content {
				width: 90%;
				flex-direction: column;
			}

			.company__info {
				display: none;
			}

			.login_form {
				padding: 2em 1em;
			}
		}
	</style>
</head>
<body>
	<form action="#" method="post">
    <div class="container-fluid">
      <div class="main-content">
        <div class="company__info">
          <h2>"Welcome</h2>
          <h2>Back"</h2>
        </div>
        <div class="login_form">
          <h2>Log In</h2>
          <form action="/login" method="POST">
            <input type="email" name="useremail" id="useremail" class="form__input" placeholder="Useremail" aria-label="Useremail" required>
            <input type="password" name="password" id="password" class="form__input" placeholder="Password" aria-label="Password" required>
            <button type="submit" name="submit" value="Submit" class="btn">Submit</button>
          </form>
          <p>Don't have an account? <a href="register.php">Register Here</a></p>
        </div>
      </div>
    </div>
  </form>
</body>
</html>
