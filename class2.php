<?php
class listMatch{
	public $listM;
	public function getMatchByName($matchname){	
		foreach ($this->listM as $key=>$value) {
		   if ($value->matchname == $matchname){
			  $Mname [] = $value;
		    }
		}
		return $Mname;
	}
	public function getMatchname(){ 
		foreach ($this->listM as $key=>$value){
			$allMatch[]= $value;
		}
		return $allMatch;
	}	
	public function getName($matchname) {
        foreach ($this->listM as $key => $value) {
            if ($value->matchname == $matchname) {
                $matchname = $key;
                break;
            }
        }
        return $key;
    }
}
?>