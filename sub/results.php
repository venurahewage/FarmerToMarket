<?php

session_start();
@include 'config.php';

if ($conn->connect_error) {
    header('LOCATION:no.html');
}

$ltel = $_SESSION['ltel'];

if($ltel == "") {
   $ltel = "";
   $link = "login.php";
}
else{
	
	$link = "profile.php";
	$getNumUser = "select fname, lname from users where contact = '$ltel'";
	$ress = $conn->query($getNumUser);
	$fnameArray=$ress->fetch_assoc();
	$fname = $fnameArray['fname'];
	$lname = $fnameArray['lname'];
}

$dis = '';
$town = '';
$finder = '';
$rows = '';

$stype = '';
$sdis  = '';
$stown = '';

/*session_start();

$dis = $_SESSION['s_dis'];
$town = $_SESSION['s_town'];*/

$sql = "select * from ads order by id desc";
$res = $conn->query($sql);


if(isset($_POST['searh'])){

	$sdis = $_POST['dis'];
	$stown = $_POST['town'];

	$ress= "select * from ads where district = '$sdis' OR city = '$stown' ORDER by id desc";
	$res = $conn->query($ress);

}


if(isset($_POST['more'])){
	$ad_id = $_POST['aid'];
	echo $ad_id;

	$_SESSION['adId']=$ad_id;
	header('LOCATION:more.php');
}



?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/fullindex.css">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
	<script src="js/jquery.js"></script>
</head>
<body>

	<header>
        <div>
            <button style="background-color: #333;" class="homebutton" name="home">Farmer2Market</button>
        </div>
        <div>
            <button>
            	<a href="<?php echo $link; ?>"><span style="margin-left: 10px;"><?php if($ltel==""){echo('POST AD - ඔබගේ දැන්වීම');}else{echo $fname;} ?></span></a>
            </button>
        </div>
    </header>

<div class="con">

<form action="results.php" method="POST">

	<!--<input type='text' id='type' name='type' placeholder="type">-->

	<div class="row">
		<div class="column">
			<h5>District</h5>
			<select class='form-control' id='dis' name='dis'>
				<option value="#">දිස්ත්‍රික්කය - District</option>
				<option value="Colombo">කොළඹ - Colombo</option>
				<option value="Kaluthara">කලුතර - Kaluthara</option>
				<option value="Gampaha">ගම්පහ - Gampaha</option>
				<option value="Galle">ගාල්ල - Galle</option>
				<option value="Matara">මාතර - Matara</option>

				<option value="Hambanthota">හම්බන්තොට - Hambanthota</option>
				<option value="Ampara">අම්පාර - Ampara</option>
				<option value="Batticola">මඩකලපුව - Batticola</option>
				<option value="Trincomalee">ත්‍රිකුණාමලය - Trincomalee</option>
				<option value="Mullaitivu">මුලතිව් - Mullaitivu</option>

				<option value="Kilinochchi">කිලිනොච්චි - Kilinochchi</option>
				<option value="Jaffna">යාපනය - Jaffna</option>
				<option value="Mannar">මන්නාරම - Mannar</option>
				<option value="Vavuniya">වවුනියාව - Vavuniya</option>
				<option value="Puttalam">පුත්තලම - Puttalam</option>

				<option value="Kurunegala">කුරුණෑගල - Kurunegala</option>
				<option value="Anuradhapura">අනුරාධපුර - Anuradhapura</option>
				<option value="Polonnaruwa">පොළොන්නරුව - Polonnaruwa</option>
				<option value="Kandy">මහනුවර - Kandy</option>
				<option value="Nuwara Eliya">නුවර‍එළිය - NuwaraEliya</option>

				<option value="Matale">මාතලේ - Matale</option>
				<option value="Kegalle">කෑගල්ල - Kegalle</option>
				<option value="Ratnapura">රත්නපුර - Ratnapura</option>
				<option value="Badulla">බදුල්ල - Badulla</option>
				<option value="Monaragala">මොණරාගල - Monaragala</option>
			</select>
		</div>

		<div class="column">
			<h5>Town</h5>
			<select class='form-control' id="size" name='town'>
				<option value="">නගරය - Town</option>
			</select>
		</div>

	</div>
	<button type='submit' class='srbtn' name='searh'>Search - සොයන්න</button>
	</form>


	<hr class='new'>
<br><br>

	<center>
		<h3>Search Results</h3>
	</center>

		<hr class='new'>
<br><br>
	
	<div class="jumbotron">
	<?php
		while ($rows = $res->fetch_assoc())
	{
	?>
	<div class="card">
        <img src="<?php echo '../'.$rows['img']; ?>" alt="Product Image">
        <div class="text-content">
        	<form action="results.php" method="POST">
            <h3><?php echo $rows['type']; ?></h3>
            <input type="hidden" name="aid" value="<?php echo $rows['id']; ?>">
			<p style='color:#A9A9A9;'><?php echo $rows['city'].' '.$rows['district']; ?></p>
			<p >Price - Rs.<?php echo $rows['price']; ?></p>
			<!-- <p>&#9742; - <?php //echo $rows['tel']; ?></p> -->

			<p style='color:#A9A9A9;'><?php $detail = substr($rows['details'], 0, 50); echo $detail; ?></p>
			<input type="submit" name="more" value="තවත් විස්තර" class="mrbtn">
			</form>
			
			<div class='w3-container'>
			<center>
			<p>&#8986; <?php echo $rows['timee']; ?></p>
			</center>
			</div>
        </div>
    </div><br>



	<?php
	}
	?>

	<br>



</div>


<script type='text/javascript'>

$(document).ready(function () {
    $("#dis").change(function () {
        var val = $(this).val();
        if (val == "Colombo") {
            $("#size").html("<option value='Nugegoda' >නුගේගොඩ - Nugegoda</option><option value='Piliyandala>පිලියන්දල - Piliyandala</option><option value='Dehiwala'>දෙහිවල - Dehiwala</option><option value='Maharagama'>මහරගම - Maharagama</option><option value='Angoda'>අංගොඩ - Angoda</option><option value='Awissawella'>අවිස්සාවේල්ල - Awissawella</option><option value='Athurugiriya'>අතුරුගිරිය - Athurugiriya</option><option value='Battaramulla'>බත්තරමුල්ල - Battaramulla</option><option value='Boralesgamuwa'>බොරලැස්ගමුව - Boralesgamuwa</option><option value='Hanwella'>හන්වැල්ල - Hanwella</option><option value='Homagama'>හෝමාගම - Homagama</option><option value='Kaduwela'>කඩුවෙල - Kaduwela</option><option value='Kesbewa'>කැස්බෑව - Kesbewa</option><option value='Kohuwala'>කොහුවල  - Kohuwala</option><option value='Kolonnawa'>කොලොන්නාව - Kolonnawa</option><option value='Kottawa'>කොට්ටාව - Kottawa</option><option value='Kotte'>කෝට්ටේ - Kotte</option><option value='Malabe'>මාලබේ - Malabe</option><option value='Moratuwa'>මොරටුව - Moratuwa</option><option value='Nawala'>නාවල - Nawala</option><option value='Padukka'>පාදුක්ක - Padukka</option><option value='Pannipitiya'>පන්නිපිටිය - Pannipitiya</option><option value='Rajagiriya'>රාජගිරිය - Rajagiriya</option><option value='Ratmalana'>රත්මලාන - Ratmalana</option><option value='Wellampitiya'>වැල්ලම්පිටිය - Wellampitiya</option>");
        } 
		
		
		else if (val == "Kaluthara") {
            $("#size").html("<option value=Horana>හොරණ - Horana</option><option value='Kaluthara'>කළුතර - Kaluthara</option><option value='Panadura'>පානදුර - Panadura</option><option value='Bandaragama'>බණ්ඩාරගම - Bandaragama</option><option value='Mathugama'>මතුගම  - Mathugama</option><option value='Aluthgama'>අලුත්ගම - Aluthgama</option><option value='Beruwala'>බේරුවල - Beruwala</option><option value='Wadduwa'>වාද්දූව - Wadduwa</option><option value='Ingiriya'>ඉංගිරිය - Ingiriya</option>");
        } 
		
		
		else if (val == "Gampaha") {
            $("#size").html("<option value='Meegamuwa'>මීගමුව - Meegamuwa</option><option value='Gampaha'>ගම්පහ - Gampaha</option><option value='Kiribathgoda'>කිරිබත්ගොඩ - Kiribathgoda</option><option value='Kelaniya'>කැළණිය - Kelaniya</option><option value='Kadawatha'>කඩවත - Kadawatha</option>");
        } 
		
		
		else if (val == "Galle") {
            $("#size").html("<option value='Galle'>ගාල්ල - Galle</option><option value='Ambalangoda'>අම්බලන්ගොඩ - Ambalangoda</option><option value='Elpitiya'>ඇල්පිටිය - Elpitiya</option><option value='Baddegama'>බද්දේගම - Baddegama</option><option value='Hikkaduwa'>හික්කඩුව - Hikkaduwa</option><option value='Ahangama'>අහන්ගම - Ahangama</option><option value='Batapola'>බටපොල - Batapola</option><option value='Benthota'>බෙන්තොට - Benthota</option><option value='Karapitiya'>කරාපිටිය - Karapitiya</option>");
        }
		
		else if (val == "Matara") {
            $("#size").html("<option value='Matara'>මාතර - Matara</option><option value='Weligama'>වැලිගම - Weligama</option><option value='Akuressa'>අකුරැස්ස - Akuressa</option><option value=''>හක්මණ - Hakmana</option><option value='Kaburupitiya'>කඹුරුපිටිය - Kaburupitiya</option><option value='Deniyaya'>දෙණියාය - Deniyaya</option><option value='Dikwella'>දික්වැල්ල - Dikwella</option><option value='Kaburugamuwa'>කඹුරුගමුව - Kaburugamuwa</option><option value='Kekunadura'>කැකණදුර - Kekunadura</option>");
        }
		
		else if (val == "Hambanthota") {
            $("#size").html("<option value='Hambanthota'>හම්බන්තොට - Hambanthota</option><option value='Tangalla'>තංගල්ල - Tangalla</option><option value='Beliaththa'>බෙලිඅත්ත - Beliaththa</option><option value='Ambalanthota'>අම්බලන්තොට - Ambalanthota</option><option value='Thissamaharama'>තිස්සමහාරාම - Thissamaharama</option>");
        }
		
		else if (val == "Ampara") {
            $("#size").html("<option value='Ampara'>අම්පාර - Ampara</option><option value='Akkaraipattu'>අක්කරෙයිපත්තු - Akkaraipattu</option><option value='Kalmunai'>කල්මුනේ - Kalmunai</option><option value='Sainthamaruthu'>සායින්දමරුතු - Sainthamaruthu</option>");
        }
		
		else if (val == "Batticola") {
            $("#size").html("<option value='Batticola'>මඩකලපුව - Batticola</option>");
        }
		
		else if (val == "Trincomalee") {
            $("#size").html("<option value='Trincomalee'>ත්‍රිකුණාමලය - Trincomalee</option><option value='Kinniya'>කින්නියා - Kinniya</option>");
        }
		
		else if (val == "Mullaitivu") {
            $("#size").html("<option value='Mullaitivu'>මුලතිව් - Mullaitivu</option>");
        }
		
		else if (val == "Kilinochchi") {
            $("#size").html("<option value='Kilinochchi'>කිලිනොච්චි - Kilinochchi</option>");
        }
		
		else if (val == "Jaffna") {
            $("#size").html("<option value='Jaffna'>යාපනය - Jaffna</option><option value='Nallur'>නල්ලූර් - Nallur</option><option value='Chavakachcheri'>චාවකච්චේරි - Chavakachcheri</option>");
        }
		
		else if (val == "Mannar") {
            $("#size").html("<option value='Mannar'>මන්නාරම - Mannar</option>");
        }
		else if (val == "Vavuniya") {
            $("#size").html("<option value='Vavuniya'>වවුනියාව - Vavuniya</option>");
        }
		
		else if (val == "Puttalam") {
            $("#size").html("<option value='Chilaw'>හලාවත - Chilaw</option><option value='Wennappuwa'>වෙන්නප්පුව - Wennappuwa</option><option value='Puttalam'>පුත්තලම - Puttalam</option><option value='Nattandiya'>නාත්තණ්ඩිය - Nattandiya</option><option value='Dankotuwa'>දංකොටුව - Dankotuwa</option><option value='Marawila'>මාරවිල - Marawila</option>");
        }
		else if (val == "Kurunegala") {
            $("#size").html("<option value='Kurunegala'>කුරුණෑගල - Kurunegala</option><option value='Kuliyapitiya'>කුලියාපිටිය - Kuliyapitiya</option><option value='Narammala'>නාරම්මල - Narammala</option><option value='Pannala'>පන්නල - Pannala</option><option value='Wariyapola'>වාරියපොල - Wariyapola</option><option value='Alawwa'>අලව්ව - Alawwa</option><option value='Bingiriya'>බිංගිරිය - Bingiriya</option><option value='Galgamuwa'>ගල්ගමුව - Galgamuwa</option><option value='Giriulla'>ගිරිඋල්ල - Giriulla</option><option value='Hettipola'>හෙට්ටිපොළ - Hettipola</option><option value='Ibbagamuwa'>ඉබ්බාගමුව - Ibbagamuwa</option><option value='Mawathagama'>මාවතගම - Mawathagama</option><option value='Nikaweratiya'>නිකවැරටිය - Nikaweratiya</option><option value='Polgahawela'>පොල්ගහවෙළ - Polgahawela</option>");
        }
		
		else if (val == "Anuradhapura") {
            $("#size").html("<option value='Anuradhapura'>අනුරාධපුර - Anuradhapura</option><option value='Kekirawa'>කැකිරාව - Kekirawa</option><option value='Medawachchiya'>මැදවච්චිය - Medawachchiya</option><option value='Thabuththegama'>තඹුත්තේගම - Thabuththegama</option><option value='Eppawala'>එප්පාවල - Eppawala</option><option value='Habarana'>හබරණ - Habarana</option><option value='Mihintale'>මිහින්තලේ - Mihintale</option><option value='Nochchiyagama'>නොච්චියාගම - Nochchiyagama</option><option value='Galnewa'>ගල්නෑව - Galnewa</option><option value='Galenbidunuwewa'>ගලෙන්බිදුනුවැව - Galenbidunuwewa</option><option value='Thalawa'>තලාව - Thalawa</option>");
        }
		else if (val == "Polonnaruwa") {
            $("#size").html("<option value='Polonnaruwa'>පොළොන්නරුව - Polonnaruwa</option><option value='Kaduruwela'>කදුරුවෙල - Kaduruwela</option><option value='Higurakgoda'>හිගුරක්ගොඩ - Higurakgoda</option><option value='Medirigiriya'>මැදිරිගිරිය - Medirigiriya</option>");
        }
		
		else if (val == "Kandy") {
            $("#size").html("<option value='Kandy'>මහනුවර - Kandy</option><option value='Katugasthota'>කටුගස්තොට - Katugasthota</option><option value='Peradeniya'>පේරාදෙනිය - Peradeniya</option><option value='Kundasale'>කුන්ඩසාලේ - Kundasale</option><option value='Akurana'>අකුරන - Akurana</option><option value='Ampitiya'>අම්පිටිය - Ampitiya</option><option value='Digana'>දිගන - Digana</option><option value='Galagedara'>ගලගෙදර - Galagedara</option><option value='Kadugannawa'>කඩුගන්නාව - Kadugannawa</option><option value='Nawalapitiya'>නාවලපිටිය - Nawalapitiya</option><option value='Pilimathalawa'>පිළිමතලාව - Pilimathalawa</option><option value='Wattegama'>වත්තේගම - Wattegama</option>");
        }
		else if (val == "NuwaraEliya") {
            $("#size").html("<option value='NuwaraEliya'>නුවර‍එළිය - NuwaraEliya</option><option value='Hatton'>හැටන් - Hatton</option><option value='Ginigathhena'>ගිනිගත්හේන - Ginigathhena</option>");
        }
		
		else if (val == "Matale") {
            $("#size").html("<option value='Matale'>මාතලේ - Matale</option><option value='Dabulla'>දඹුල්ල - Dabulla</option><option value='Galewela'>ගලේවෙල - Galewela</option><option value='Ukuwela'>උකුවෙළ - Ukuwela</option><option value='Palapathwela'>පලාපත්වෙල - Palapathwela</option><option value='Sigiriya'>සීගිරිය - Sigiriya</option><option value='Yatawatta'>යටවත්ත - Yatawatta</option><option value='Raththota'>රත්තොට - Raththota</option>");
        }
		
		else if (val == "Kegalle") {
            $("#size").html("<option value='Kegalle'>කෑගල්ල - Kegalle</option><option value='Mawanella'>මාවනැල්ල - Mawanella</option><option value='Warakapola'>වරකාපොළ - Warakapola</option><option value='Rabukkana'>රඹුක්කන - Rabukkana</option><option value='Ruwanwella'>රුවන්වැල්ල - Ruwanwella</option><option value='Karawanella'>කරවනැල්ල - Karawanella</option><option value='Aguruwella'>අගුරුවැල්ල - Aguruwella</option>");
        }
		else if (val == "Ratnapura") {
            $("#size").html("<option value='Ratnapura'>රත්නපුර - Ratnapura</option><option value='Kuruwita'>කුරුවිට - Kuruwita</option><option value='Pelmadulla'>පැල්මඩුල්ල - Pelmadulla</option><option value='Eheliyagoda'>ඇහැලියගොඩ - Eheliyagoda</option><option value='Balangoda'>බලංගොඩ - Balangoda</option><option value='Pabahinna'>පඹහින්න - Pabahinna</option>");
        }
		
		else if (val == "Badulla") {
            $("#size").html("<option value='Badulla'>බදුල්ල - Badulla</option><option value='Bandarawela'>බණ්ඩාරවෙල - Bandarawela</option><option value='Welimada'>වැලිමඩ - Welimada</option><option value='Mahiyanganaya'>මහියංගනය - Mahiyanganaya</option><option value='Haliela'>හාලිඇල - Haliela</option>");
        }
		
		else if (val == "Monaragala") {
            $("#size").html("<option value='Monaragala'>මොණරාගල - Monaragala</option><option value='Wellawaya'>වැල්ලවාය - Wellawaya</option><option value='Bibila'>බිබිල - Bibila</option><option value='Buttala'>බුත්තල - Buttala</option><option value='Katharagama'>කතරගම - Katharagama</option>");
        }
		
    });
});

</script>



</body>
</html>