<?php
namespace Model;

class Memoria extends Entidade{
	public $C = [0 => '#', 1 => 'Categoria', 2 => 'Sub categoria', 3 => 'Descrição'];
	public $c = [0 => 'id', 1 => 'categoria', 2 => 'sub_categoria', 3 => 'descricao'];
	public $l = [0 => 5, 1 => 3, 2 => 30, 3 => 2000];
	
	public function __construct(array $config, $unit = false){
        parent::__construct($config, 'memoria', 'm', $unit);
	}
	
	public function paginar(array $filtros = [], $limite = null, $pagina = 1){
		$this->orm->selecionar('m', '*')->filtrar('m', 'id', 'like', '');
        
		$this->filtrar('id', '=', $filtros);
		$this->filtrar('categoria', '=', $filtros);
		$this->filtrar('sub_categoria', 'like', $filtros);
		$this->filtrar('descricao', 'like', $filtros);
		
		if($limite){
			$this->total = $this->orm->ler()->quantificar();
			$this->paginacao = new \Miti\Paginacao($this->total, $limite, $pagina, 11);
			$this->orm->limitar($limite, $this->paginacao->getInicio());
		}
		
		$this->orm
			->selecionar('c', 'nome', 'c_nome')
			->juntar('categoria', 'c', 'm', 'categoria', 'c', 'id')
			->ordenar('m', 'id', 'desc')
		;
		
		return $this->orm->ler();
	}
}
