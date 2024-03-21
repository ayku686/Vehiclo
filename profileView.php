<?php
session_start();
require 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $sid = $_SESSION['id'];
		$name = dataFilter($_POST['name']);
	    $mobile = dataFilter($_POST['mobile']);
        $sql = "UPDATE Seller set sname='$name',smobile='$mobile' where sid='$sid'";
        $result = mysqli_query($conn, $sql);
    
    if ($result === TRUE) {
        echo "User details updated successfully";
    } else {
        echo "Error updating user details: " . $conn->error;
    }
}
function dataFilter($data)
{
	$data = trim($data);
 	$data = stripslashes($data);
	$data = htmlspecialchars($data);
  	return $data;
}
if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] != 1) {
    $_SESSION['message'] = "You have to Login to view this page!";
    header("Location: Login/error.php");
}
?>

<!DOCTYPE HTML>

<html lang="en">

<head>
    <title>Profile:
        <?php echo $_SESSION['Username']; ?>
    </title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap\js\bootstrap.min.js"></script>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="login.css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-layers.min.js"></script>
    <script src="js/init.js"></script>
    <link rel="stylesheet" href="css/skel.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style-xlarge.css" />

</head>


<body>

    <?php
    require 'menu.php';
    ?>

    <section id="one" class="wrapper style1 align">
        <div class="inner">
            <div class="box">
                <header>
                    <center>
                        <span><img src="<?php echo 'images/profileImages/profile0.png' ?>" class="image-circle"
                                class="img-responsive" height="50%"></span>
                        <br>
                        <h2>
                            <?php echo $_SESSION['Name']; ?>
                        </h2>

                        <br>
                    </center>
                </header>
                <div class="row">
                    <p>&emsp;
                    <p>&emsp;
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <b>
                            <font size="+2" color="black">RATINGS : </font>
                        </b>
                        <font size="+2">
                            <?php echo $_SESSION['Rating']; ?>
                        </font>
                    </div>
                    <div class="col-sm-3">
                        <b>
                            <font size="+2" color="black">Email ID : </font>
                        </b>
                        <font size="+2">
                            <?php echo $_SESSION['Email']; ?>
                        </font>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <br />
                <div class="row">
                    <p>&emsp;
                    <p>&emsp;
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <b>
                            <font size="+2" color="black">Mobile No : </font>
                        </b>
                        <font size="+2">
                            <?php echo $_SESSION['Mobile']; ?>
                        </font>
                    </div>
                    <div class="col-sm-3">
                        <b>
                            <font size="+2" color="black">ADDRESS : </font>
                        </b>
                        <font size="+2">
                            <?php echo $_SESSION['Addr']; ?>
                        </font>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <div class="12u$">
                    <center>

                        <div class="row uniform">
                            <p>&emsp;</p>
                            <p>&emsp;</p>
                            <p>&emsp;</p>
                            <p>&emsp;</p>
                            <p>&emsp;</p>
                            <p>&emsp;</p>
                            <p>&emsp;</p>
                            <p>&emsp;</p>
                            <div class="3u 12u$(xsmall)">
                                <button type="submit" onclick="document.getElementById('id01').style.display='block'"
                                    name="update_details" class="btn btn-primary">Update Details</button>
                            </div>
                            <div class="3u 12u$(xsmall)">
                                <a href="uploadProduct.php" class="btn btn-danger" style="text-decoration: none;">Upload
                                    Vehicle</a>
                            </div>
                            <div class="3u 12u$(large)">
                                <a href="Login/logout.php" class="btn btn-danger" style="text-decoration: none;">LOG
                                    OUT</a>
                            </div>
                        </div>
                        <div class="container">
                        <div id="id01" class="modal">
                            <form method="POST" action="profileView.php" class="modal-content animate">
                                <div class="imgcontainer">
                                    <span onclick="document.getElementById('id01').style.display='none'" class="close"
                                        title="Close Modal">&times;</span>
                                </div class="row uniform 50%">

                                <div>
                                    <div class="7u$">
                                        <label for="new_mobile">New Mobile:</label>
                                        <input type="text" id="mobile" name="mobile" style="color:black"
                                            value="" required>
                                    </div>
                                    <div class="7u$">
                                        <label for="new_email">New Name:</label>
                                        <input type="text" id="name" name="name" style="color:black" value=""
                                            required>
                                    </div>

                                </div><br>
                               <center>
                                    <div class="row uniform">
                                        <div class="7u 12u$(small)">
                                            <input type="submit" value="Update" />
                                        </div>
                                    </div>
                               <center>
                            </form>
                        </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>

        </div>
    </section>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>



</body>

</html>