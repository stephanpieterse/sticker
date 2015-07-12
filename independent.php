<?php
		$glen = (isset($_GET['length']) ? $_GET['length'] : 8);
		$glim = (isset($_GET['limbs']) ? $_GET['limbs'] : 4);

		$sticker = new StickingGenerator;
		$sticker->setMode('plain');
		
		for($i = 1; $i <= $glim; $i++){
			$limbs[$i]['pattern'] = $sticker->get_randomSticking($glen,2);
			$limbs[$i]['accent'] = $sticker->get_randomAccent($glen);
			
			$pattern = $limbs[$i]['pattern'];
			$accent = $limbs[$i]['accent'];
			$limbs[$i]['full'] = $sticker->applyAccent($pattern,$accent);
		}
?>
Patterns used:
<br/>
<?php		

		foreach($limbs as $l){
			echo $l['pattern'];
			echo '<br/>';
			echo $l['accent'];
			echo '<br/>';
			//echo $l['full'];
			//echo '<br/>';
		}
		?>
		<p>
		Complete exercise:<br/>
		<?php
		$x = 1;
		foreach($limbs as $l){
			echo $x;
			echo '| ' . $l['full'] . ' |';
			echo '<br/>';
			$x++;
		}
	?>
	</p>
	<p>LEGEND:<br/>
	- : Rest<br/>
	x : Unaccented Note<br/>
	X : Accented Note<br/>
	</p>
