<?php 

class MatchTeam {
    public $match;
    public $teams = array();
    public $results = array();
    
    public function __construct($match, $teams)
    {
        $this->match = $match;
        $this->teams = $teams;
    }

    public function addResult($result1, $result2)
    {
        $this->results[0]=$result1;
        $this->results[1]=$result2;
    }
}
?>