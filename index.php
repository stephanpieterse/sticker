<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Sticking Generator</title>
<link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
	<div class="title">Sticker<br/>Random Sticking Generator</div>
	<div class="sticking">
	<?php
	
		require_once("drumgen.php");
		
		if(isset($_GET['mode'])){
			switch($_GET['mode']){
				case 'linear':
					include("linear.php");
				break;
				
				case 'independent':
					include("independent.php");
				break;
			}
		}else{
			include("linear.php");
		}
		
	?>
	</div>
	<br/>
	<div class="links center">
		<form method="get" action="index.php">
		Mode:
		<select name="mode">
		<option value="linear">Linear Exercise</option>
		<option value="independent">Independence Exercise</option>
		</select>	
		
		Length:
		<select name="length">
		<?php
			for($i = 1; $i <= 16; $i++){
				echo '<option ';
				if(isset($_GET['length']) && $_GET['length'] == $i){echo "selected"; }
				echo '>' . $i . '</option>';
			}
		?>
		</select>
		
		Limbs:
		<select name="limbs">
		<?php
			for($i = 1; $i <= 4; $i++){
				echo '<option ';
				if(isset($_GET['limbs']) && $_GET['limbs'] == $i){echo "selected"; }
				echo '>' . $i . '</option>';
			}
		?>
		</select>
		<br/>
		<input type="submit" value="Get a new sticking" />
		</form>
	</div>
	<br/>
	<div class="notes">
		This is a quick script I put together for drummers (and myself) to get some new rhythmical ideas, while developing technical ability.
		<br/>
		For some more ideas on applying the patterns, check out <a href="http://rubyhemisphere.dedicated.co.za/accents/">the book</a><br/>
		This a quick web script of an old program I wrote, <a href="http://rubyhemisphere.dedicated.co.za/genp/">GenP</a><br/>
		<br/>
		Created by <a href="mailto:stephanpieterse@rubyhemisphere.deicated.co.za">Stephan Pieterse</a>
		<br/>
		Hosted on <a target="_blank" href="http://rubyhemisphere.dedicated.co.za">rubyhemisphere</a>
		<br/>
		If you want to use this php class in your project, send me an email!
	</div>
</body>
</html>
