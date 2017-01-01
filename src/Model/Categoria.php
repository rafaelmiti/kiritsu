<?php
namespace Model;

class Categoria extends Repositorio
{
    public $C = [0 => '#', 1 => 'Nome'];
    public $c = [0 => 'id', 1 => 'nome'];
    public $l = [0 => 3, 1 => 30];

    public function __construct(array $config, $unit = false)
    {
        parent::__construct($config, 'categoria', 'c', $unit);
    }

    public function listar()
    {
        return $this->orm->selecionar('c', '*')->ordenar('c', 'nome', 'asc')->ler();
    }
}
