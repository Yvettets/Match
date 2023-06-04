<?php
 class Matchf {
	public $matchname;
	public $location ;
	public $date;
	public $hour;
	public function __construct($matchname, $location, $date, $hour){
		$this->matchname = $matchname;
		$this->location = $location;
		$this->date = $date;
		$this->hour = $hour;
	}
}
?>