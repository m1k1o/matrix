<?php

class Compose
{
  private $_matrix;
	
  public function __construct(Matrix &$_matrix){
    $this->_matrix = $_matrix;
  }
  
	// Zobrazí ako tabuľku
	public function display(){
		//$log = Log::get();
		//Log::clear();
		
		$mx = $this->_matrix->get();
		$output = '<table style="text-align:right;font-family:monospace;border: 1px solid black;">';
		foreach($mx as $i => $r){
			$output .= '<tr><th>'.$i.':</th>';
			foreach($r as $c){
				$output .= '<td style="width:30px;'.($c == 0 ? "background-color:black;" : ($c == 1 ? "background-color:lime;" : "")).'">'.round($c, 2).'</td>';
			}
			$output .= '</tr>';
		}
		return $output . '</table>';//.'<p>'.$log.'</p>';
	}
	
	// Wolfam Alpha output
	public function wa(){
		$mx = $this->_matrix->get();
		$output = [];
		foreach($mx as $i => $r){
			$output[] = '{'.implode(",", array_map(function($a){return round($a, 2);}, $r)).'}';
		}
		return '{'.implode(",", $output).'}';
	}
}