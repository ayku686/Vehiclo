<?php
	if(isset($_SESSION['logged_in']) AND $_SESSION['logged_in'] == 1)
	{
		$hlink="index1.php";
		$loginProfile = "My Profile: ". $_SESSION['Username'];
		$logo = "glyphicon glyphicon-user";
		if($_SESSION['Category']== 1)
		{
			$link = "profileView.php";
		}
		else {
				$link = "profileView1.php";
		}
		
	}
	else
	{
		$loginProfile = "Login";
		$link = "../index.php";
		$hlink="../index.php";
		$logo = "glyphicon glyphicon-log-in";
	}
?>

<!DOCTYPE html>
			<header id="header">
				<h1><a href="index.php">Vehiclo	</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="<?= $hlink; ?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
						<?php if(isset($_SESSION['logged_in']) AND $_SESSION['logged_in'] == 1 && $_SESSION['Category'] == 0): ?>
							<li><a href="./favorites.php"><span class="glyphicon glyphicon-shopping-cart"> Favourites</a></li>
						<?php endif; ?>
						<li><a href="<?= $link; ?>"><span class="<?php echo $logo; ?>"></span>Profile</a></li>
						<li><a href="./market.php"><span class="glyphicon glyphicon-shopping-cart"> DigiMart</a></li>
					</ul>
				</nav>
			</header>

	</body>
</html>
