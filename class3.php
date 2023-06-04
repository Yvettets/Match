<?php
class Team {
    public $id ;
    public $teamname;

    public function __construct($id, $teamname)
    {
        $this->id = $id;
        $this->teamname = $teamname;
        
    }
}
?>