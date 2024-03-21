<?php
	session_start();
	require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>FarmEasy</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap\js\bootstrap.min.js"></script>
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="login.css"/>
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<body class>

		<?php
			require 'menu.php';
			function dataFilter($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		?>

		<!-- One -->
			<section id="main" class="wrapper style1 align-center" >
				<div class="container">
						<h2>Welcome to DigiMart</h2>

				<?php
					if(isset($_GET['n']) AND $_GET['n'] == 1):
				?>
					<h3>Select Filter</h3>
					<form method="GET" action="productMenu.php?">
						<input type="text" value="1" name="n" style="display: none;"/>
						<center>
							<div class="row">
							<div class="col-sm-4"></div>
							<div class="col-sm-2">
								<div class="select-wrapper" style="width: auto" >
									<select name="type" id="type" required style="background-color:white;color: black;">
										<option value="all" style="color: black;">List All</option>
										<option value="Cars" style="color: black;">Cars</option>
										<option value="Bikes" style="color: black;">Bikes</option>
										<option value="Scooters" style="color: black;">Scooters</option>
										<option value="Trucks" style="color: black;">Trucks</option>
										<option value="Autos" style="color: black;">Autos</option>
									</select>
							  	</div>
							</div>
							<div class="col-sm-2">
								<input class="button special" type="submit" value="Go!" />
							</div>
							<div class="col-sm-4"></div>
						</div>
						</center>
					</form>
				<?php endif; ?>

				<section id="two" class="wrapper style2 align-center">
				<div class="container">
				<?php
					if(!isset($_GET['type']) OR $_GET['type'] == "all")
					{
					 	$sql = "SELECT * FROM sproduct WHERE 1";
					}
				    if(isset($_GET['type']) AND $_GET['type'] == "Cars")
					{
						$sql = "SELECT * FROM sproduct WHERE pcat = 'Cars'";
					}
					if(isset($_GET['type']) AND $_GET['type'] == "Bikes")
					{
						$sql = "SELECT * FROM sproduct WHERE pcat = 'Bikes'";
					}
					if(isset($_GET['type']) AND $_GET['type'] == "Scooters")
					{
						$sql = "SELECT * FROM sproduct WHERE pcat = 'Scooters'";
					}
					if(isset($_GET['type']) AND $_GET['type'] == "Trucks")
					{
						$sql = "SELECT * FROM sproduct WHERE pcat = 'Trucks'";
					}
					if(isset($_GET['type']) AND $_GET['type'] == "Autos")
					{
						$sql = "SELECT * FROM sproduct WHERE pcat = 'Autos'";
					}
					$result = mysqli_query($conn, $sql);

					?>
					<div class="row">
					<?php

						while($row = $result->fetch_array()):
							$picDestination = "images/productImages/".$row['pimage'];
						?>
							<div class="col-md-4">
							<section>
							<strong><b><h2 class="title" style="color:black; "><?php echo $row['product'].'';?></h2></b></strong>
							<a href="review.php?pid=<?php echo $row['pid'] ;?>" > <img class="image fit" src="<?php echo $picDestination;?>" height="220px;"  /></a>

							<div style="align: left">
							<blockquote><?php echo "Type : ".$row['pcat'].'';?><br><?php echo "Price : Rs ".$row['price'].'';?><br></blockquote>

						</section>
						</div>

						<?php endwhile;	?>


					</div>

			</section>
					</header>

			</section>

	</body>
</html>
