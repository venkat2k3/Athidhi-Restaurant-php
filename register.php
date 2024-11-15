<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "user_data";

$conc = mysqli_connect($server, $username, $password, $dbname);

if (!$conc) {
    die("Failed: Unable to connect - " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $button = $_POST['submit'];
    if ($button == 'Submit') {
        $name = $_POST['useremail'];
        $password = $_POST['password'];
        $number = $_POST['phn_number'];

        $query1 = "SELECT * FROM userdetails WHERE email='$name'";
        $result = mysqli_query($conc, $query1);
        if (mysqli_num_rows($result) > 0) {
            $error = urlencode("User with same email id already exists");
            header("Location: register.php?error=$error");
            exit();
        }

        if (!preg_match("/^[a-zA-Z0-9_\-\.]+@[a-z]+\.[a-z]{2,3}$/", $name)) {
            $error = urlencode("Email is not in the correct format");
            header("Location: register.php?error=$error");
            exit();
        } 
        
        elseif (!preg_match("/^[89][0-9]{9}$/", $number)) {
            $error = urlencode("Phone number is not in the correct format");
            header("Location: register.php?error=$error");
            exit();
        } 
        
        elseif (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{6,}$/", $password)) {
            $error = urlencode("Password must contain 1 special character, 1 uppercase letter, 1 number, and be at least 6 characters long");
            header("Location: register.php?error=$error");
            exit();
        } 
        
        else {
            $query = "INSERT INTO userdetails (email, password, contactNumber) VALUES ('$name', '$password', '$number')";
            if (mysqli_query($conc, $query)) {
                header("Location: login.php");
                exit();
            } else {
                $error = urlencode("Error in database operation: " . mysqli_error($conc));
                header("Location: register.php?error=$error");
                exit();
            }
        }
    }
}

mysqli_close($conc);
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
			width: 80%;
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
                    <h2>"Join us </h2>
					<h2>today!"</h2>
                </div>
                <div class="login_form">
                    <h2>Register</h2>
                    <form action="/login" method="POST">
                        <input type="email" name="useremail" id="useremail" class="form__input" placeholder="Useremail" aria-label="Useremail" required>
                        <input type="password" name="password" id="password" class="form__input" placeholder="Password" aria-label="Password" required>
                        <input type="text" name="phn_number" id="password" class="form__input" placeholder="PhoneNumber" aria-label="PhoneNumber" required>
                        <button type="submit" name="submit" value="Submit" class="btn">Submit</button>
                    </form>
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
