<?php

class Parse
{
	public static function plain_text($text){
		$output = array();
		$input = preg_split("/(\r\n|\n|\r)/", $text);
		foreach($input as $row){
			$row = trim($row);
			if(empty($row)) continue;
			
			$output[] = array_map("floatval", preg_split("/[^0-9-]+/", $row));
		}
		return $output;
	}
}