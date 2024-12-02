<?php
session_start();

@include 'config.php';

//$_SESSION['username']


if(isset($_POST['submit'])){

	$ltel = $_POST['ltel'];
	$lpass = $_POST['lpass'];
	$db_pass = '';
	


	$sqll = ("select * from users where contact = '$ltel'");
	$result = $conn->query($sqll);

	if ($result->num_rows < 1) {
		echo ($result->num_rows);
        echo "<script type='text/javascript'>alert('Not a Valid Number. Please Sign Up');</script>";
    } else {
        while ($lrow = $result->fetch_assoc()) {
            if($lrow['pswd'] == $lpass) {
                $_SESSION['ltel'] = $ltel;
                header('LOCATION: profile.php');

            } else {
                echo "<script type='text/javascript'>alert('Wrong Password');</script>";
            }
        }
    }


	
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>

	<header>
        <div>
            <p>Farmer2Market</p>
        </div>

    </header>


<br><br><br>
<div class="con">

<center>
	<br>
	<br><br><br>
	<div class="jumbo">
	<h2>LogIn</h2>
	<form action='login.php' method="POST">

		<input type='text' name='ltel' placeholder="Phone No (දුරකතන අංකය)">
		<input type='password' name='lpass' placeholder="Password (රහස් අංකය)">
		<br><br>
		<hr class="new">

		<button type="submit" id='loginbtn' class="lgbtn2" name='submit'>Login (ඇතුලු වෙන්න)</button>
		<br>
		OR
		<h4><a style='color: #24E592;'href='signup.php'>Sign Up</a></h4>

	</form>

	</div>
</center>
</body>
</html>