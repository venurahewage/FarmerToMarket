<?php
session_start();
@include 'config.php';


$ad_id = $_SESSION['adId'];


//echo $ad_id;


$getAdData = "select * from ads where id = '$ad_id'";
$res = $conn->query($getAdData);





?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/fullindex.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<style type="text/css">
		ul {
		  list-style-type: none;
		  margin: 0;
		  padding: 0;
		  overflow: hidden;
		  background-color: #24E592;
		  height:50px;
		  text-align: center;
		}

		li {
		  float: left;
		}

		li a {
		  display: block;
		  color: white;
		  text-align: center;
		  padding: 14px 16px;
		  text-decoration: none;
		  background-color: #F6D011;
		  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		  height:10vh;
		  
		}
		h1,h2,h3,h4,h5,h6{
			font-family:verdana;
		}
	</style>
</head>
<body>


<div class="jumbotron">
	<?php
		while ($rows = $res->fetch_assoc())
	{
	?>
	<div class="card">
        <img style="width:200px;height:200px;" src="<?php echo '../'.$rows['img']; ?>" alt="Product Image">
        <div class="text-content">
        	<form action="index.php" method="POST">
            <h3><?php echo $rows['type']; ?></h3>
            <input type="hidden" name="aid" value="<?php echo $rows['id']; ?>">
			<p style='color:#A9A9A9;'><?php echo $rows['city'].' '.$rows['district']; ?></p>
			<p >Price - Rs.<?php echo $rows['price']; ?></p>
			<!-- <p>&#9742; - <?php //echo $rows['tel']; ?></p> -->

			<p style='color:#A9A9A9;'><?php echo $rows['details']; ?></p>
			
			</form>
			
			<div class='w3-container'>
			<center>
			<p>&#8986; <?php echo "Posted By ". $rows['owner']." - ".$rows['timee']; ?></p>
			</center>
			</div>
        </div>
    </div><br>



	<?php
	}
	?>


</div>

</body>

</html>