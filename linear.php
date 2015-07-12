<?php
		$glen = (isset($_GET['length']) ? $_GET['length'] : 8);
		$glim = (isset($_GET['limbs']) ? $_GET['limbs'] : 4);

		$sticker = new StickingGenerator;
		$pattern = $sticker->get_randomSticking($glen,$glim);
		$accent = $sticker->get_randomAccent($glen);
		$full = $sticker->applyAccent($pattern,$accent);
		$limbs = $sticker->get_limbs();
		
		echo '<br/>';
		echo 'Pattern: ' . $pattern;
		echo '<br/>';
		echo 'Accents: ' . $accent;
		echo '<br/>';
		echo 'Complete: ' . $full;
		echo '<br/>';
?>
<p>
<?php	
		foreach($limbs as $l){
			echo $l;
			echo '<br/>';
		}
?>
</p>
<p>LEGEND:<br/>
	Lowercase: Unaccented<br/>
	Uppercase: Accented<br/>
	r : Right hand<br/>
	l : Left hand<br/>
	f : Bass drum (right foot)<br/>
	h : HiHats (left foot)<br/>
	</p>
