<?php
namespace Model;

class Inspiracao extends Entidade{
	public $C = [0 => '#', 1 => 'Nome', 2 => 'Imagem'];
	public $c = [0 => 'id', 1 => 'nome', 2 => 'imagem'];
	public $l = [0 => 3, 1 => 50, 2 => null];
	
	public function __construct(array $config, $unit = false){
        parent::__construct($config, 'inspiracao', 'i', $unit);
	}
	
	public function lerAleatorio(){
		return $this->orm->selecionar('i', 'id')->selecionar('i', 'nome')->ordenarAleatoriamente()->ler();
	}
}
