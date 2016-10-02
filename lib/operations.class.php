<?php

class Operations
{
	// Sčítanie dvoch matíc
	private static function basic(Matrix $m1, Matrix $m2, $operation){
		if($m1->get_size() != $size = $m2->get_size()){
			throw new Exception("Matice musia byť rovnakého typu.");
		}
		
		$m = [];
		for($row=0;$row<$size[0];$row++){
			$m_row = [];
			for($col=0;$col<$size[1];$col++){
				$m_row[] = $operation(floatval($m1->get($row, $col)), floatval($m2->get($row, $col)));
			}
			$m[] = $m_row;
		}
		
		return new Matrix($m);
	}
	
	// Sčítanie dvoch matíc
	public static function addition(Matrix $m1, Matrix $m2){
		return self::basic($m1, $m2, function($val1, $val2){
			return $val1 + $val2;
		});
	}
	
	// Odčítanie dvoch matíc
	public static function subtraction(Matrix $m1, Matrix $m2){
		return self::basic($m1, $m2, function($val1, $val2){
			return $val1 - $val2;
		});
	}
	
	// Násobenie matice konštantou
	public static function const_multiplication(Matrix $m1, $const){
		return self::basic($m1, $m1, function($val1) use ($const){
			return $const * $val1;
		});
	}
	
	// Súčin matíc
	public static function multiplication(Matrix $m1, Matrix $m2){
		$size1 = $m1->get_size();
		$size2 = $m2->get_size();
		
		if($size1[1] != $size2[0]){
			throw new Exception("Matice nemožno násobiť.");
		}
		
		$m = [];
		for($row=0;$row<$size1[0];$row++){
			$m_row = [];
			for($col=0;$col<$size2[1];$col++){
				$result = 0;
				for($i=0;$i<$size1[1];$i++){
					$result += $m1->get($row, $i) * $m2->get($i, $col);
				}
				$m_row[] = $result;
			}
			$m[] = $m_row;
		}
		
		return new Matrix($m);
	}
  
	// Transponovaná matica sa získa výmenou riadkov so stĺpcami,
	public static function transpose(Matrix $m1){
		$size = $m1->get_size();
		
		$m = [];
		for($col=0;$col<$size[1];$col++){
			$m_row = [];
			for($row=0;$row<$size[0];$row++){
				$m_row[] = $m1->get($row, $col);
			}
			$m[] = $m_row;
		}
		
		return new Matrix($m);
	}
}