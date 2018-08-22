<?php
	session_start();
	
	if(isset($_POST['LOGIN'])){
		include 'databases/dblogin.php';
		$userN = $_POST['username'];
		$passW = $_POST['password'];				
		$sql = "SELECT * FROM users WHERE username='$userN' AND password='$passW'";
		$result = mysqli_query($conn, $sql);
			if(!$row = mysqli_fetch_assoc($result)){
				echo "Incorrect username or password!";
			} else {
				$_SESSION['id'] = $row['username'];
				header("Location: store-data.php");
			}
		}   
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Vollkorn:600" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Login</title>
</head>
<body class="bg-dark">
	<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
		<h2 class="text-center text-white mb-4">Auto-Elektrik Arpad Tot</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card rounded-0">
					<div class="card-header">
						<h3 class="mb-0">Login</h3>
					</div>
					<div class="card-body">
						<form  action="" method="POST" class="form" role="form" autocomplete="off" id="formLogin">
							<div class="form-group">
								<label for="uname1">Username</label>
								<input type="text" name="username" class="form-control form-control-lg rounded-0" name="uname1" id="uname1" required="">
								<div class="invalid-feedback">Oops, you missed this one.</div>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control form-control-lg rounded-0" id="pwd1" required="" autocomplete="new-password">
								<div class="invalid-feedback">Enter your password too!</div>
							</div>
							<div>
							<p>Sensitive data will be handled with care</p>
							</div>
							<!-- <div>
								<label class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input">
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description small text-dark">Remember me on this computer</span>
								</label>
							</div> -->
							<button type="submit" name="LOGIN" class="btn btn-success btn-lg float-right" id="btnLogin" >Login</button>
						</form>
					</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	</div>
<!--/container-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
	</body>
</html>


