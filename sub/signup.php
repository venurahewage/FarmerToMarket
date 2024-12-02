<?php

session_start();
@include 'config.php';


if(isset($_SESSION['username']) == "") {
   $user = "";
   $link = "sub/login.php";
}
else{
	$user = $_SESSION['username'];
	$link = "sub/profile.php";
}

if(isset($_POST['home'])){
	$_SESSION['ltel'] = $ltel;
	header('LOCATION:../index.php');
}


if(isset($_POST['submit'])){

	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$tel = $_POST['tel'];
	$pass = $_POST['pass'];
	$passc = $_POST['passc'];

	$chektel = substr($tel,0,3);

	$checktel = "select * from users where contact = '$tel'";
	$conf = $conn->query($checktel);

	if($conf->num_rows > 0){
		echo "<script type='text/javascript'>alert('This Phone Number have used before');</script>";
		//header('LOCATION:signup.php');
	}

	else{
		
		if(strlen($tel) == 10 and strlen($pass) > 5 and strlen($passc) > 5){

			if(ctype_digit($tel)){
				if($chektel=='070' or $chektel=='071' or $chektel=='072' or $chektel=='075' or $chektel=='076' or $chektel=='077' or $chektel=='078'){
					
						if($pass == $passc){

							$val="INSERT INTO users(fname,lname,pswd,contact) VALUES ('$fname', '$lname', '$pass', '$tel')";
							$resultt = $conn->query($val);
							
							header('LOCATION:login.php');
						}

						else{
							echo "<script type='text/javascript'>alert('Password Not Match');</script>";
						}
						
				}
				else{
					echo "<script type='text/javascript'>alert('Invalid Mobile Number');</script>";
				}
				
			}
			
			else{
				echo "<script type='text/javascript'>alert('Invalid Mobile Number');</script>";
			}

		}


			
		else{
			echo "<script type='text/javascript'>alert('Fill All Fields');</script>";
		}
		
	}
		
		
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/full.css">
</head>
<body>
	<header>
        <div>
        	<form action="signup.php" method="POST">
            <button style="background-color: #333;" class="homebutton" name="home">Goviya</button>
         </form>
        </div>

    </header>

<br><br><br><br>
<div class="con">
<center>

	<h2>Create Account</h2>
	<hr class="new">
	<br>
	<form action='signup.php' method="POST">


		<input type='text' name='fname' maxlength="30" placeholder="First Name - මුල් නම">
		<input type='text' name='lname' maxlength="30" placeholder="Last Name - අවසාන නම">
		<input type='text' name='tel' maxlength="10" placeholder="Mobile Number (ජංගම දුරකථන අංකය) - 07x xxxx xxx">
		<input type='password' name='pass' placeholder="Password more than 5 characters (රහස් අංකය)">
		<input type='password' name='passc' placeholder="Confirm Password more than 5 characters (නැවත රහස් අංකය)">
		
		<br><br>
		<hr class="new">
		<br>

		<!--<input type="checkbox" value="1" onclick="terms_changed(this)">-->
		<p>සත්‍ය තොරතුරු ලබා දෙන්න.</p>
		<br>
		<button type="submit" id='btn' class="lgbtn" name='submit'>Submit (ඇතුළත් කරන්න)</button>

	</form>

</center>
</div>

</body>
</html>	