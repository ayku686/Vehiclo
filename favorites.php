<?php
	session_start();
	require 'db.php';
    if(!isset($_SESSION['logged_in']) OR $_SESSION['logged_in'] == 0)
	{
		$_SESSION['message'] = "You need to first login to access this page !!!";
		header("Location: Login/error.php");
	}
    $bid = $_SESSION['id'];
    if(isset($_GET['flag']))
    {
        $pid = $_GET['pid'];
		$check_sql = "SELECT COUNT(*) as fav_count FROM favourites WHERE bid = '$bid'";
    	$check_result = mysqli_query($conn, $check_sql);
    	$row = mysqli_fetch_assoc($check_result);
    	$fav_count = $row['fav_count'];

    if ($fav_count >= 3) {
        echo '<script>alert("You Cannot add more than 3 favorites.");</script>';
    } else {
        $sql = "INSERT INTO favourites (bid, pid) VALUES ('$bid', '$pid')";
        $result = mysqli_query($conn, $sql);
    }
    }
	function deleteFavorite($conn, $pid) {
		$sql = "DELETE FROM favourites WHERE pid = '$pid'";
		if ($conn->query($sql) === TRUE) {
			return "Favorite deleted successfully";
		} else {
			return "Error deleting favorite: " . $conn->error;
		}
	}
	
	// Check if the delete form is submitted
	if(isset($_POST['delete_favorite'])) {
		$pid = $_POST['pid'];
		$delete_result = deleteFavorite($conn, $pid);
		echo $delete_result;
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Vehiclo: My Cart</title>
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

		<style>
			.product-info {
            display: block;
        }
		</style>
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
						<h2>Favourites</h2>

				<section id="two" class="wrapper style2 align-center">
				<div class="container">
					<div class="row">
					<?php
                        $sql = "SELECT * FROM favourites WHERE bid = '$bid'";
                        $result = mysqli_query($conn, $sql);
						while($row = $result->fetch_array()):
                            $pid = $row['pid'];
                            $sql = "SELECT * FROM sproduct WHERE pid = '$pid'";
                            $result1 = mysqli_query($conn, $sql);
                            $row1 = $result1->fetch_array();
							$picDestination = "images/productImages/".$row1['pimage'];
						?>
							<div class="row">
							<section>
							<strong><h2 class="title" style="color:black; "><?php echo $row1['product'].'';?></h2></strong>
							<a href="review.php?pid=<?php echo $row1['pid'] ;?>" > 
							<img class="image fit" src="<?php echo $picDestination;?>" alt="" width="300px" height="200"/></a>

							<div style="align: left" class="product-info">
							<blockquote><?php echo "Type : ".$row1['pcat'].'';?><br><?php echo "Price : ".$row1['price'].' /-';?><br></blockquote>
							<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                                        <button type="submit" name="delete_favorite" class="btn btn-danger">Remove</button>
                                    </form>
						</section>
						</div>
                    <?php endwhile;	?>
					</div>
			</section>
					</header>

			</section>
	</body>
</html>
