<?php
namespace Model;

class Repositorio
{
    protected $config;
    protected $nome;
    protected $alias;
    protected $unit;

    protected $orm;
    protected $paginacao;
    protected $total;

    public function __construct(array $config, $nome, $alias, $unit)
    {
        $this->config = $config;
        $this->nome = $nome;
        $this->alias = $alias;
        $this->unit = $unit;

        $this->orm = new \Miti\ORM($this->config, $this->nome, $this->alias);
    }

    public function getORM()
    {
        return $this->orm;
    }

    public function getPaginacao()
    {
        return $this->paginacao;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function criar(array $tupla)
    {
        $banco = $this->orm->criar($tupla);
        $this->cometer($banco);
        return $this->orm;
    }

    public function ler(array $tupla)
    {
        return $this->orm
            ->selecionar($this->alias, '*')
            ->filtrar($this->alias, $this->c[0], '=', $tupla[$this->c[0]])
            ->ler()
        ;
    }

    public function atualizar(array $tupla)
    {
        $banco = $this->orm
            ->filtrar($this->alias, $this->c[0], '=', $tupla[$this->c[0]])
            ->atualizar($tupla)
        ;

        $this->cometer($banco);
        return $this->orm;
    }

    protected function filtrar($campo, $operador, array $filtros)
    {
        if (isset($filtros[$campo])) {
            if ($filtros[$campo] !== '') {
                $this->orm->eFiltrar($this->alias, $campo, $operador, $filtros[$campo]);
            }
        }
    }

    public function deletar(array $tupla)
    {
        $banco = $this->orm
            ->filtrar($this->alias, $this->c[0], '=', $tupla[$this->c[0]])
            ->deletar()
        ;

        $this->cometer($banco);
        return $this->orm;
    }

    protected function cometer(\Miti\Banco $banco)
    {
        $this->unit?: $banco->cometer();
    }
}
