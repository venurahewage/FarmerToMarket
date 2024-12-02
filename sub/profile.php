<?php

session_start();
@include 'config.php';

if ($conn->connect_error) {header('LOCATION:no.html');}



$userID = '';
$ltel = $_SESSION['ltel'];
//echo $ltel;
$pass ='';

$Ntel = '';
$Npass = '';
$c_name = 'ltel';


// if($ltel != "") {
    
// 	$c_value = $_SESSION['ltel'];
// 	setcookie($c_name, $c_value);
// 	echo $c_value . "NN";
// }
// else{
// 	if(isset($_COOKIE[$c_name])) {
//     	echo $c_value. " DD";
// 	}
// 	else{
// 		echo "No";
// 	}
// }


if(isset($_SESSION['ltel']) == null) {
   $ltel = null;
}
else{
	$sqlo = "select * from users where contact = '$ltel'";
	$result = $conn->query($sqlo);

	$row = $result->fetch_assoc();

	$pass = $row['pswd'];
	$userID = $row['id'];

	$getNumUser = "select fname, lname from users where contact = '$ltel'";
	$res = $conn->query($getNumUser);
	$fnameArray=$res->fetch_assoc();
	$fname = $fnameArray['fname'];
	$lname = $fnameArray['lname'];


	$adsql = ("select * from ads where tel = '$ltel' order by id desc");
	$adlist = $conn->query($adsql);

}







if(isset($_POST['delete'])){
	$ad_id = $_POST['delId'];
	echo $ad_id;
	$del = $conn->query("delete from ads where id='$ad_id'");
	header('LOCATION:profile.php');
}


if(isset($_POST['update'])){

	$Nfname = $_POST['fname'];
	$Nlname = $_POST['lname'];
	$Ntel = $_POST['tel'];
	$Npass = $_POST['pass'];

	if(strlen($Ntel) < 0){
		$Ntel = $tel;
	}
	else{
		$Ntel = $Ntel;
	}

	if(strlen($Npass) < 0){
		$Npass = $pass;
	}
	else{
		$Npass = $Npass;
	}
	if($Nfname == $fname){
		$Nfname = $fname;
	}
	else{
		$Nfname = $Nfname;
	}

	if($Nlname == $lname){
		$Nlname = $lname;
	}
	else{
		$Nlname = $Nlname;
	}


	//echo $Nfname ." ". $Nlname ." ". $Ntel . " ". $Npass;


	$up = "update users set fname = '$Nfname', lname = '$Nlname', pswd = '$Npass', contact = '$Ntel' WHERE id = '$userID'";
	$adup = "update ads set owner = '$Nfname', tel = '$Ntel' where tel = '$ltel'";

	$conn->query($up);
	$conn->query($adup);
	session_destroy();

    header('LOCATION:login.php');

	

}

if(isset($_POST['gotoad'])){
	$acctel = $_POST['tel'];
	$_SESSION['ltel'] = $acctel;
	header('LOCATION:adpost.php');
}

if(isset($_POST['editad'])){
	$ad_id = $_POST['delId'];
	$_SESSION['adID'] = $ad_id;
	$_SESSION['acctel'] = $ltel;
	header('LOCATION:editad.php');
	
	
		
}

if(isset($_POST['home'])){
	$_SESSION['ltel'] = $ltel;
	header('LOCATION:../index.php');
}

if(isset($_POST['logout'])){
	session_destroy();
	header('LOCATION:../index.php');
}



?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/profile.css">
	<script src="js/jquery.js"></script>
	
	<style>
	
		.butt {
		  background-color: red;
		  border: none;
		  color: white;
		  padding: 5px 5px;
		  text-align: center;
		  text-decoration: none;
		  font-size: 16px;
		  margin: 1px 1px;
		  display: block;
		  
		}
		
		.butt2{
			background-color: green;
		}
		
		.avatar {
		  vertical-align: middle;
		  width: 80%;
		  height: auto;
		  border-radius: 50%;
		  padding:10px;
		}
	
	</style>

</head>
<body>

<header>

		<form action="profile.php" method="POST">
			<!-- <div>
            	<a href="../index.php"><img src="img/logo.png" alt="Your Logo" style="height: 50px;"></a>
        	</div> -->
            <button style="background-color: #333;" class="homebutton" name="home">Farmer2Market</button>
            <button type="submit" id="logout" name="logout">Log Out</button>
        </form>


</header>



<div class="con">

	<div class="w3-card" style="width:100%">
   
		<div class="row">
        <div class="column">
			<img src="img/avt.png" alt="Avatar" class="avatar">
    	</div>
    <div class="w3-container">
    	<div class="column">
		<form action='profile.php' method="POST">
			<br>
			<p>First Name :- </p><input id='fname' type='textt' name='fname' value="<?php echo $fname;?>">
			<p>Last Name :- </p><input id='lname' type='textt' name='lname' value="<?php echo $lname;?>">
			<p>Tel No :- </p><input id='tel' type='textt' name='tel' value="<?php echo $ltel;?>">
			<p>Password :- </p><input id='pass' type='passwordd' name='pass' placeholder="Password">
		</div>
			<hr class='new'>

<script type="text/javascript">
		document.getElementById('tel').disabled = false;
		document.getElementById('pass').disabled = false;
</script>
			<br>
			<center>
			<button id='proedit' onclick='editable()' class="lgbtn3">Edit</button> <button id='toEdit' onclick='editable()' type='submit' name='update' class="lgbtn3">Save</button>
			</center>

		<br><br>
		<center><button onclick='editable()' type='submit' class='lgbtn2' name='gotoad'> Post Your Ad - ඔබගේ දැන්වීම පළකරන්න</button></center>
		<br><br>
		</form>
		
	</div>
  	</div>
<script type="text/javascript">
document.getElementById('fname').disabled = true;
document.getElementById('lname').disabled = true;
document.getElementById('tel').disabled = true;
document.getElementById('pass').disabled = true;
document.getElementById('toEdit').disabled = true;
</script>
		<br><br><br><br><br>
		<hr>
		<br>

<script type="text/javascript">
	
	function editable(){
		document.getElementById('fname').disabled = false;
		document.getElementById('lname').disabled = false;
		document.getElementById('tel').disabled = false;
		document.getElementById('pass').disabled = false;
		document.getElementById('toEdit').disabled = false;
		document.getElementById('proedit').disabled = true;

	}


</script>

		<center><h3>My Ads</h3></center>

<script type="text/javascript">
	
	function operate(){
		document.getElementById('id').disabled = false;
	}

</script>

	
	<?php while($ads=$adlist->fetch_assoc()){ ?>
	
		<div class="card2">
			<form action="profile.php" method='POST'>
				<input class='input' type='tex' id='id' name='delId' value='<?php echo $ads['id']; ?>' disabled>
				<h2 align='center'><?php echo $ads['type']; ?></h2>
				
				<hr class="new">
				<h3><?php echo $ads['city'].' '.$ads['district']; ?></h3>
				<h3 style='color:white;background-color:#F8356F;margin:0;padding:5px;border-radius:.5rem;display:inline-block;box-shadow: 0 2px 5px 0 rgba(0,0,0,.56);'>Price - Rs.<?php echo $ads['price']; ?></h3>
				<h3>&#9742; - <?php echo $ads['tel']; ?></h3>
				<h4><?php echo $ads['details']; ?></h4>
				
				<div class='w3-container'>
				<center>
				<p>&#8986; <?php echo $ads['timee']; ?></p>
				</center>
				</div>
				<hr class="new2">
				<center>
				<button onclick='operate()' style="width:70%;" type='submit' name='delete' class="butt">Delete - දැන්වීම ඉවත්කරන්න</button>
				<br>
				<button onclick='operate()' style="width:70%;" type='submit' name='editad' class="butt butt2">Edit - දැන්වීම වෙනස් කරන්න</button>
			 	</center>
			
			</form>
			<br><br><br>
			
		</div>


	<br>
	<?php } ?>
<br><br><br><br><br>


</div>
</body>
</html>