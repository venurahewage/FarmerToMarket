<?php

session_start();
@include 'config.php';

$query = 'select * from chats ORDER by timee desc';
$res = $conn->query($query);


if(isset($_POST['submit'])){

	$msg = $_POST['message'];

	date_default_timezone_set("Asia/Colombo");
	$tim_in = date("Y:m:d - H:i:s");


	$val = $conn->query("INSERT INTO chats(msg,timee) VALUES ('$msg', '$tim_in')");

	header('LOCATION:chat.php');
	
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chats</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../css/fullindex.css">

    


<style>
	*{
		margin: 5px;
		padding: 5px;
	}
  h5 {
	font-family: Verdana;
	font-size: 25px;
  }

  hr.newchat {
	  border-top: 1px solid #E2E2E2;
	  width:95%;
	}
  
  h3 {
	font-family: Verdana;
	font-size: 13px;
  }
  
  p {
	font-family: Verdana;
	font-size: 13px;
  }
</style> 
  
</head>
<body>

<center><h5><b>පණිවිඩයක් ඇතුලත් කරන්න</b></h5></center>

<div>
	<form action='chat.php' method='POST'>
		<textarea name="message" rows="10" cols="100" style="width:100%;" placeholder="ඔබට අවශ්‍ය යමක් සොයගැනීමට මෙහි පණිවිඩයක් ඇතුළත් කරන්න. (කරුණාකර ඔබගේ දුරකථන අංකයක්ද ඇතුලත් කරන්න)"></textarea><br>
		<button type="submit" name="submit" class="srbtn" style='background-color:#24E592 !important;'>Send</button>

	</form>
</div>


<div class='container'>
	<center><h5><b>පණිවිඩ</h5></b></center>
<br>


  <?php
	while ($rows = $res->fetch_assoc())
	{
  ?>
	
	<div style="width: 100%;box-shadow: 0 1px 3px 0 rgba(0,0,0,.20);">
		<div>
			<h3>&#8986; <?php echo $rows['timee']; ?></h3>
			
			<p><?php echo $rows['msg']; ?></p>
		</div>
	</div>
	<br>
	<?php
	}
	?>

  	
	
</body>
</html>
