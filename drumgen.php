<?php
/*
 * @author Stephan Pieterse
 * @package Sticker
 * 
 * This class contains the basic functions used for the Sticker website.
 * */

class StickingGenerator{
	
	private $lastSticking = '';
	private $lastAccent = '';
	private $mode = '';
	
	/*
	 * Right now only no mode and 'plain' mode is supported.
	 * */
	public function setMode($newMode){
		$this->mode = $newMode;
		
		return true;	
	}
	
	private function get_singleLimb($pattern, $limb){
		$pattern = preg_replace( '/[^' . $limb . '\s]/', '-', $pattern);
		
		return $pattern;
	}
	
	private function generate_randomNumber($base, $length = 8){
		$min = 1;
		$max = pow($base,$length);
		$num = mt_rand($min,$max);
		
		$convNum = base_convert($num,10,$base);
		
		return $convNum;
	}
	
	private function convert_numToAccent($num, $length){
		$replaced = $this->padNum($num,$length);
		$replaced = str_replace('0','x',$replaced);
		$replaced = str_replace('1','X',$replaced);
		
		return $replaced;
	}
	
	private function convert_numToStick($num, $length){
		$num = $this->padNum($num, $length);
		switch($this->mode){
			case 'plain':
				$replaced = $num;
				$replaced = str_replace('0','-',$replaced);
				$replaced = str_replace('1','x',$replaced);
				$replaced = str_replace('2','-',$replaced);
				$replaced = str_replace('3','x',$replaced);
			break;
			
			default:
				$replaced = $num;
				$replaced = str_replace('0','r',$replaced);
				$replaced = str_replace('1','l',$replaced);
				$replaced = str_replace('2','f',$replaced);
				$replaced = str_replace('3','h',$replaced);
			break;
		}
		
		return $replaced;
	}
	
	private function padNum($number,$length){
		$replaced = $number;
		if(mb_strlen($replaced) < $length){
			$diff = $length - strlen($replaced);
			$pad = str_repeat('0',$diff);
			$replaced = $pad . $replaced;
		}
		
		if(mb_strlen($replaced) > $length){
			$replaced = mb_substr($replaced,0,$length);
		}
		
		return $replaced;
	}
	
	private function matchLength($refString, $matchString){
		$slen = strlen($refString);
		$alen = strlen($matchString);
		
		if($alen != $slen){
			if($alen > $slen){
				$matchString = substr($matchString,0,$slen);
			}
			
			if($alen < $slen){
				
			}
		}
		
		return $matchString;
	}
	
	public function applyAccent($sticking,$accent){
		$accent = $this->matchLength($sticking, $accent);
		
		$newPattern = '';
		
		$j = mb_strlen($sticking);
		for ($k = 0; $k < $j; $k++) {
			$charS = mb_substr($sticking, $k, 1);
			$charA = mb_substr($accent, $k, 1);
			
			switch($charA){
				case 'X':
					$newPattern .= strtoupper($charS);
				break;
				
				case 'x':
					$newPattern .= strtolower($charS);
				break;
				
				default:
				break;
			}
		}
		
		return $newPattern;
	}
	
	public function get_randomAccent($length){
		$sticknum = $this->generate_randomNumber(2,$length);
		$sticking = $this->convert_numToAccent($sticknum,$length);
		$this->lastAccent = $sticking;
		
		return $sticking;
	}
	
	public function get_randomSticking($length = 8, $base = 2){
		$sticknum = $this->generate_randomNumber($base, $length);
		$sticking = $this->convert_numToStick($sticknum,$length);
		$this->lastSticking = $sticking;
		
		return $sticking;
	}
	
	public function get_sticking($num, $length = 8, $base = 2){
		$sticking = $this->convert_numToStick($num,$length);
		$this->lastSticking = $sticking;
		
		return $sticking;
	}
	
	/*
	 * Seperates the last generated sticking into the 4 different parts.
	 * */
	public function get_limbs(){
		$sticking = $this->lastSticking;
		$limbs[] = $this->get_singleLimb($sticking,'r');
		$limbs[] = $this->get_singleLimb($sticking,'l');
		$limbs[] = $this->get_singleLimb($sticking,'f');
		$limbs[] = $this->get_singleLimb($sticking,'h');
		
		return $limbs;
	}
	
	/*
	 * Public wrapper for the music xml file generated.
	 * */
	public function get_midiXML(){
		return make_midiXML();
	}
	
	/*
	 * 
	 * */
	private function make_midiXML(){
		ob_start();
		echo file_get_contents('mus_header.xml');
		echo file_get_contents('mus_footer.xml');
		$fullXML = ob_get_clean();
		
		return $fullXML;
	}
	
}
