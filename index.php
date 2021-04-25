<?php
include_once('conexion.php');
if(isset($_POST['login']))
{
	$username =  isset($_POST['username']) ? filter_var($_POST["username"],FILTER_SANITIZE_STRING):"";
	$password = isset($_POST["password"]) ? filter_var($_POST["password"],FILTER_SANITIZE_STRING):"";
	
	if ( $username == "" || $password == "" ){
		?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Holy guacamole!</strong> All the fields are required
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<?php
	}
	else{

		$sql = "SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . $password ."'";
		$result = $conn->query($sql);

		
		if ($result && ($result->num_rows > 0)) {
			// output data of each row
			// Start the session
			var_dump($result);
			session_start();
			$row = $result->fetch_assoc();
			//echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["password"]. "<br>";
			
			$_SESSION["user_id"] =  $row["id"];
			$_SESSION["username"] =  $row["username"];
			$_SESSION["firstname"] =  $row["firstname"];
			$_SESSION["lastname"] =  $row["lastname"];

			//$_SESSION["favanimal"] = "cat";
			
			header("Location: http://localhost/hackathon/main.php");
			die();
		} else {
		?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Holy guacamole!</strong> Username or Password Invalid
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>LogIn</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="description" content="Demo project with jQuery">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	    <link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="container">
			
			<div class="row">
				<div class="col-12 d-flex flex-column justify-content-center" style="height: 100vh;">
					<img src="images/logo.jpg" class="img-fluid mx-auto" alt="">
					<form class="form-horizontal align-self-center form-login" method="POST">
						<h1 class="text-center text-red">Login</h1>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="control-group">
									<label class="control-label" for="inputEmail">Email</label>
									<div class="controls">
									<input type="email" class="form-control" id="inputEmail" name="username" placeholder="Email">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="control-group">
									<label class="control-label" for="inputPassword">Password</label>
									<div class="controls">
										<input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="control-group">
									<div class="controls">
										<label class="checkbox">
										<input type="checkbox"> Remember me
										</label>
										<div>
										<button type="submit" name="login" class="btn btn-success btn-block">Sign in</button>
										</div>
									</div>
									<a href="signup.php" class="message d-block pt-3">Don't have an account? Sign up</a>
								</div>
							</div>
						</div>
					  </form>
				</div>
			</div>
			
		</div>
	</body>
</html>