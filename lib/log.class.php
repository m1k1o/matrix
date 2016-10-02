<?php

class Log
{
	private static $_text = '';

	public function static put($_text){
		self::_text[] = $_text;
	}

	public function static get(){
		return implode('<br />', self::_text);
	}

	public function static clear(){
		self::_text = '';
	}

}