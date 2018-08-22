<?php
session_start();
$output = '';
$table = '';
$Dname = '';
$Dcarmodel = '';
$Ddate = '';
$Ddescription = '';
// checks if the session has started and grants access to the website 
	if (!$_SESSION['id']) {
		header("Location: login.php");
		} 
		// else {
		// echo 'Logged in as '.$_SESSION['id'].'. ';
		// }
// destroys the session and log the user out 
	if(isset($_GET['LOGOUT']) ){
		session_destroy();
		header("Location: login.php");
	}
// input data - onclick submit button, checks the input data from the user, then saves them to a database
	if(isset($_POST['SAVE_DATA']) ){
		include 'databases/dbuser.php';
		$aPerson = $_POST['person'];
		$aNumber = $_POST['number'];
		$aType = $_POST['vehicleType'];
		$aModel = $_POST['vehicleModel'];
		$aYear = $_POST['vehicleYear'];
		$aVin = $_POST['vehicleVin'];
		$aOdo = $_POST['vehicleOdo'];
		$aDate = date("Y/m/d");
		$aDescription = $_POST['description'];
		$sql = "INSERT INTO info (Name,Number,Cartype,Carmodel,modelYear,Vinnumber,Odometer,Date,Description) VALUES ('$aPerson','$aNumber','$aType','$aModel','$aYear','$aVin','$aOdo','$aDate','$aDescription')";
			if(!mysqli_query($conn,$sql)){
				echo '<script>
						alert("Not inserted!");
						</script>';
				} else {
				echo '<script>
					alert("Successfully Inserted!");
					</script>';
			}
	}
// search data
	if(isset($_POST['SEARCH'])) {
	include 'databases/dbuser.php';
		$searchq = $_POST['search'];
			if(!$searchq){
				$dataMissing = 'Ne sme biti prazna!';
			} else {
				//ask for data
				$query = mysqli_query($conn,"SELECT * FROM info WHERE Name LIKE '%$searchq%'") or die("could not search!");
				$count = mysqli_num_rows($query);
				if($count == 0) {
					$output = 'There was no such results!';
				} else {
					while($row = mysqli_fetch_array($query)) {
						$Dname = $row['Name'];
						$Dnumber = $row['Number'];
						$Dcartype = $row['Cartype'];
						$Dcarmodel = $row['Carmodel'];
						$Dmodelyear = $row['modelYear'];
						$Dvinnumber = $row['Vinnumber'];
						$Dodometer = $row['Odometer'];
						$Ddate = $row['Date'];
						$Ddescription = $row['Description'];
						$table .= '
							<table class="table table-striped table-dark m-0 mb-1">
							<thead>
								<tr>
									<th scope="col">'.$Dname.'</th>
									<th scope="col">'.$Dcartype.'/'.$Dcarmodel.'</th>
									<th scope="col">'.$Ddate.'</th>
								</tr>
							</thead>
							</table>
							<div id="table" class="table" style="display:none;">
							<ul class="list-group">
								<li class="list-group-item">Ime i prezime: <span>'.$Dname.'</span></li>
								<li class="list-group-item">Broj telefona: +381<span>'.$Dnumber.'</span></li>
								<li class="list-group-item">Marka: <span>'.$Dcartype.'</span></li>
								<li class="list-group-item">Model: <span>'.$Dcarmodel.'</span></li>
								<li class="list-group-item">Godiste: <span>'.$Dmodelyear.'</span></li>
								<li class="list-group-item">VIN: <span>'.$Dvinnumber.'</span></li>
								<li class="list-group-item">KM: <span>'.$Dodometer.'</span></li>
								<li class="list-group-item">Datum: <span>'.$Ddate.'</span></li>
								<li class="list-group-item">Opis: <span>'.$Ddescription.'</span></li>
							</ul>	
							</div>
							<button onclick="myFunction(this)" class="btn btn-sm m-0 btn-success">Detaljnije</button>
							<hr>
							';
						// $output .= 
						// '<ul>
						// 	<li>Ime i prezime: <span>'.$Dname.'</span></li>
						// 	<li>Broj telefona: <span>'.$Dnumber.'</span></li>
						// 	<li>Marka: <span>'.$Dcartype.'</span></li>
						// 	<li>Model: <span>'.$Dcarmodel.'</span></li>
						// 	<li>Godiste: <span>'.$Dmodelyear.'</span></li>
						// 	<li>VIN: <span>'.$Dvinnumber.'</span></li>
						// 	<li>KM: <span>'.$Dodometer.'</span></li>
						// 	<li>Datum: <span>'.$Ddate.'</span></li>
						// </ul>';

						// <ul>
						// 	<li>Ime i prezime: <span>'.$Dname.'</span></li>
						// 	<li>Broj telefona: <span>'.$Dnumber.'</span></li>
						// 	<li>Marka: <span>'.$Dcartype.'</span></li>
						// 	<li>Model: <span>'.$Dcarmodel.'</span></li>
						// 	<li>Godiste: <span>'.$Dmodelyear.'</span></li>
						// 	<li>VIN: <span>'.$Dvinnumber.'</span></li>
						// 	<li>KM: <span>'.$Dodometer.'</span></li>
						// 	<li>Datum: <span>'.$Ddate.'</span></li>
						// 	<li>Opis: <span>'.$Ddescription.'</span></li> 
						// </ul>
					}
				}
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
	<title>Unos podataka</title>
</head>
<body>
	<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
		<div class="container">
			<div class="justify-content">
				<h1 class="navbar-brand">Pozdrav, <?php echo $_SESSION['id']?> </h1>
				<a href="logout.php" class="btn btn-outline-warning btn-sm">Log out</a>
			</div>
		</div>
	</nav>
	<br>
	<div class="container">
		<div class="row">
			<!-- unos podataka deo -->
			<div class="col-lg-4">
				<h3>Unos Podataka</h3>
				<form action="" method="POST" name="inputValidate" autocomplete="off" onsubmit="return validateForm()">
					<div class="form-group">
						<label>Ime i prezime</label>
						<input class="form-control" name="person" type="text">
					</div>
					<div class="form-group">
						<label>Broj telefona</label>
						<input  class="form-control" name="number" type="number">
					</div>
					<div class="form-group">
						<label>Marka</label>
						<select class="form-control" name="vehicleType">
							<option disabled selected></option>
							<option value="Volkswagen">Volkswagen</option>
							<option value="Audi">Audi</option>
							<option value="Skoda">Skoda</option>
							<option value="Seat">Seat</option>
							<option value="Opel">Opel</option>
							<option value="Mercedes">Mercedes</option>
							<option value="BMW">BMW</option>
							<option value="Renault">Renault</option>
							<option value="Hyundai">Hyundai</option>
							<option value="Kia">Kia</option>
							<option value="Alfa Romeo">Alfa Romeo</option>
							<option value="-">-</option>
						</select>
					</div>
					<div class="form-group">
						<label>Model</label>
						<input class="form-control" id="model-chk" name="vehicleModel" type="text">
					</div>
					<div class="form-group">
						<label>Godište</label>
						<select class="form-control" name="vehicleYear">
							<option disabled selected></option>
							<option value="1994">1994</option>
							<option value="1995">1995</option>
							<option value="1996">1996</option>
							<option value="1997">1997</option>
							<option value="1998">1998</option>
							<option value="1999">1999</option>
							<option value="2000">2000</option>
							<option value="2001">2001</option>
							<option value="2002">2002</option>
							<option value="2003">2003</option>
							<option value="2004">2004</option>
							<option value="2005">2005</option>
							<option value="2006">2006</option>
							<option value="2007">2007</option>
							<option value="2008">2008</option>
							<option value="2009">2009</option>
							<option value="2010">2010</option>
							<option value="2011">2011</option>
							<option value="2012">2012</option>
							<option value="2013">2013</option>
							<option value="2014">2014</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="-">-</option>
						</select>
					</div>
					<div class="form-group">
						<label>Šasija</label>
						<input class="form-control" name="vehicleVin" type="text">
					</div>
					<div class="form-group">
						<label>Stanje KM</label>
						<input class="form-control" name="vehicleOdo" type="number">
					</div>
					<div class="form-group">
						<label>Opis popravke</label>
						<p>nem checkeli hogy van e input a fieldbe</p>
						<textarea class="form-control"  name="description" type="text" rows="3"></textarea>
					</div>
					<button class="btn btn-primary" name="SAVE_DATA" type="submit">Sačuvaj</button>
					<a href="store-data.php" class="btn btn-dark">Reset</a>
					
				</form>
				<br>
				<hr>
			</div>
			<div class="col-lg-6 mx-auto">
				<h3>Pretraga podataka</h3>
				<h4><?php
					if(isset($_POST['SEARCH'])) {
						if(!$searchq){
							echo $dataMissing;
						}
					}
					?>
				</h4>
				
				<form action="" method="POST" class="form-group pt-2" autocomplete="off">
					<input class="form-control mb-2" type="search" name="search" placeholder="Npr. ime, prezime, vozilo...">
					<button class="btn btn-primary btn-block" type="submit" name="SEARCH">Search</button>
				</form>
				<?php
					echo $table;
				?>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-sm navbar-dark bg-dark mt-3">
		<div class="container">
			<div class="justify-content">
				
			</div>
		</div>
	</nav>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
	<script src="javascript/user-input-validate.js"></script>
	<script>
		function myFunction(el) {
  		 var x = el.previousElementSibling;
   		 x.style.display = 'block';
		
 		}
	</script>    
</body>
</html>