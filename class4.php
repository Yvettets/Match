<?php
class ListTeam {
    public $teams = array();
    
    function addTeam($team) {
      $this->teams[] = $team;
    }
    
    function getTeamById($id) {
      foreach($this->teams as $team) {
        if($team->id == $id) {
          return $team;
        }
      }
      return null;
    }

    public function getAllTeams()
    { 
        foreach ($this->teams as $key=>$value)
        {
            $allTeams[]= $value;
        }
        return $allTeams;
    }
    
}
?>