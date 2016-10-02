<?php

class Matrix
{
	private $_mx;
	private $_size;
	
	public function __construct($_mx){
		$this->_mx = $_mx;
		
		if(!is_array($this->_mx)){
			throw new Exception("Neplatný vstup.");
		}
		
		$row_size = 0;
		$col_size = false;
		foreach($this->_mx as $row){
			$row_size++;
			
			if($col_size !== false && $col_size != count($row)){
				throw new Exception("Počet stĺpcov nieje jednotný.");
			}
			
			$col_size = count($row);
		}
		
		if($row_size == 0 || $col_size === false){
			throw new Exception("Matica je prázdna.");
		}
		
		$this->_size = [$row_size, $col_size];
	}

	// Násobenie
	private function mp($n1, $n2){
		return round($n1 * $n2, 5);
	}

	/*
		Operácie s maticou
	*/
	
	// ERO 1 - Výmena poradia ľubovoľných dvoch riadkov.
	public function row_interchange($row_1, $row_2){
		if($row_1 == $row_2){
			return;
		}
		
		Log::put('R<sub>'.$row_1.'</sub> <=> R<sub>'.$row_2.'</sub>');
		
		$buff = $this->_mx[$row_2];
		$this->_mx[$row_2] = $this->_mx[$row_1];
		$this->_mx[$row_1] = $buff;
	}

	// ERO 2 - Vynásobenie riadku nenulovou konštantou.
	public function row_multiply($row, $multiplier = 1){
		if($multiplier == 1){
			return;
		}
		
		if($multiplier == 0){
			throw new Exception("Povolené je iba násobenie nenulovým číslom.");
		}
		
		Log::put('R<sub>'.$row.'</sub> = <strong>'.round($multiplier, 2).'</strong> &bull; R<sub>'.$row.'</sub>');
		foreach($this->_mx[$row] as &$col_2){
			$col_2 = $this->mp($col_2, $multiplier);
		}
	}

	// ERO 3 - Pripočítanie nenulového násobku jedného riadku k inému riadku.
	public function row_add($row_1, $row_2, $multiplier = 1){
		// Povolené je iba násobenie nenulovým číslom. Ale keď ku riadku pirpočítate nulový, hodnota sa nezmení.
		if($multiplier == 0){
			return;
		}

		Log::put('R<sub>'.$row_1.'</sub> = R<sub>'.$row_1.'</sub> + '.($multiplier != 1 ? '<strong>'.round($multiplier, 2).'</strong> &bull; ' : '').'R<sub>'.$row_2.'</sub>');
		foreach($this->_mx[$row_2] as $i => $col_2){
			$this->_mx[$row_1][$i] += $this->mp($col_2, $multiplier);
		}
	}
	
	/*
		Funkcie pre získavanie dát
	*/
	
	public function is_square(){
		return $this->_size[0] == $this->_size[1];
	}
	
	// Získa hodnotu z matice
	public function get($row = null, $col = null){
		if($row === null){
			return $this->_mx;
		}
		
		if($col === null){
			return $this->_mx[$row];
		}
		
		return $this->_mx[$row][$col];
	}

	// Získa veľkosť matice
	public function get_size(){
		return $this->_size;
	}
	
	// Absolútna hodnota súčtu čísel v riadku
	public function row_sum($row){
		$sum = 0;
		foreach($this->_mx[$row] as $i){
			$sum += abs($i);
		}
		return $sum;
	}
	
	// Absolútna hodnota súčtu čísel v stĺpci
	public function col_sum($col){
		$sum = 0;
		$size = $this->get_size();
		for($i = 0; $i < $size; $i++){
			$sum += abs($this->_mx[$i][$col]);
		}
		return $sum;
	}
}