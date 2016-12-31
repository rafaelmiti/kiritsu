<?php
namespace Model;

class Chuva extends Entidade{
	public $C = [0 => '#', 1 => 'Data', 2 => 'Intensidade'];
	public $c = [0 => 'id', 1 => 'data', 2 => 'intensidade'];
	public $l = [0 => 5, 1 => 10, 2 => 1];
	
	public function __construct(array $config, $unit = false){
        parent::__construct($config, 'chuva', 'c', $unit);
	}
	
	public function paginar(array $filtros = [], $ordem = 'asc', $limite = null, $pagina = 1){
        $this->orm->selecionar('c', '*')->filtrar('c', 'id', 'like', '');
        
		$this->filtrar('id', '=', $filtros);
		$this->filtrar('data', '=', $filtros);
		$this->filtrar('intensidade', '=', $filtros);
		
		if($limite){
			$this->total = $this->orm->ler()->quantificar();
			$this->paginacao = new \Miti\Paginacao($this->total, $limite, $pagina, 11);
			$this->orm->limitar($limite, $this->paginacao->getInicio());
		}
		
        $this->orm->ordenar('c', 'data', $ordem);
        
		return $this->orm->ler();
	}
}
