<?php
namespace Model;

class Agenda extends Repositorio
{
    public $C = [0 => '#', 1 => 'Categoria', 2 => 'Atividade', 3 => 'Data', 4 => 'Hora', 5 => 'Periódico', 6 => 'História'];
    public $c = [0 => 'id', 1 => 'categoria', 2 => 'atividade', 3 => 'data', 4 => 'hora', 5 => 'periodico', 6 => 'historia'];
    public $l = [0 => 5, 1 => 30, 2 => 1000, 3 => 10, 4 => 8, 5 => 1, 6 => 1];

    public function __construct(array $config, $unit = false)
    {
        parent::__construct($config, 'agenda', 'a', $unit);
    }

    public function historiar(array $tupla)
    {
        $banco = $this->orm->filtrar($this->alias, $this->c[0], '=', $tupla[$this->c[0]])->atualizar([$this->c[6] => 1]);
        $this->cometer($banco);
        return $this->orm;
    }

    public function agendar(array $tupla)
    {
        $banco = $this->orm->filtrar($this->alias, $this->c[0], '=', $tupla[$this->c[0]])->atualizar([$this->c[6] => 0]);
        $this->cometer($banco);
        return $this->orm;
    }

    public function paginar(array $filtros = [], $ordem = 'asc', $limite = null, $pagina = 1)
    {
        foreach ($this->c as $campo) {
            $this->orm->selecionar($this->alias, $campo);
        }

        $this->orm->filtrar($this->alias, $this->c[0], 'like', '');
        $this->filtrar($this->c[0], '=', $filtros);
        $this->filtrar($this->c[1], 'like', $filtros);
        $this->filtrar($this->c[2], 'like', $filtros);
        $this->filtrar($this->c[3], '=', $filtros);
        $this->filtrar($this->c[6], '=', $filtros);

        if ($limite) {
            $this->total = $this->orm->ler()->quantificar();
            $this->paginacao = new \Miti\Paginacao($this->total, $limite, $pagina, 11);
            $this->orm->limitar($limite, $this->paginacao->getInicio());
        }

        $this->orm->ordenar($this->alias, $this->c[3], $ordem)->ordenar($this->alias, $this->c[4], $ordem);

        return $this->orm->ler();
    }
}
