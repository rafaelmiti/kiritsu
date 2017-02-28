<?php
namespace Controller;

use Model\Agenda;

class AgendaController
{
    private $app;

    public function __construct()
    {
        global $app;
        $this->app = $app;
    }

    public function getVisualizar()
    {
        $pagina = isset($_GET['pagina'])? $_GET['pagina']: 1;

        try {
            $agenda = new Agenda($this->app->config('config'));
            $banco = $agenda->paginar([$agenda->c[6] => '0'], 'asc', 15, $pagina);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $this->app->render('agenda/visualizar.php', ['app' => $this->app, 'agenda' => $agenda, 'banco' => $banco]);
    }

    public function getCadastrar()
    {
        $agenda = new Agenda($this->app->config('config'));
        $this->app->render('agenda/cadastrar.php', ['app' => $this->app, 'agenda' => $agenda]);
    }

    public function postCadastrar()
    {
        try {
            $agenda = new Agenda($this->app->config('config'));
            $agenda->criar($_POST);
            $this->app->flash('status', 'Sucesso ao cadastrar o agendamento!');
        } catch (\Exception $e) {
            $this->app->flashNow('status', $e->getMessage());
            $this->app->render('agenda/cadastrar.php', ['app' => $this->app]);
            $this->app->stop();
        }

        $_POST[$agenda->c[6]]? $this->app->redirect("/l/historico/visualizar"): $this->app->redirect("/l/agenda/visualizar");
    }

    public function getEditar($c0)
    {
        try {
            $agenda = new Agenda($this->app->config('config'));
            $a = $agenda->ler([$agenda->c[0] => $c0])->vetorizar();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $a = \Miti\Tratamento::escapar($a);

        $this->app->render('agenda/editar.php', ['app' => $this->app, 'agenda' => $agenda, 'a' => $a]);
    }

    public function postEditar($c0)
    {
        try {
            $agenda = new Agenda($this->app->config('config'));
            $_POST[$agenda->c[0]] = $c0;
            $agenda->atualizar($_POST);
            $this->app->flash('status', 'Sucesso ao editar o agendamento!');
        } catch (\Exception $e) {
            $this->app->flash('status', $e->getMessage());
        }

        $this->app->redirect("/l/agenda/editar/$c0");
    }

    public function getHistoriar($c0)
    {
        try {
            $agenda = new Agenda($this->app->config('config'));
            $agenda->historiar([$agenda->c[0] => $c0]);
            $this->app->flash('status', 'Sucesso ao historiar o agendamento!');
        } catch (\Exception $e) {
            $this->app->flash('status', $e->getMessage());
        }

        $this->app->redirect('/l/historico/visualizar');
    }

    public function getExcluir($c0)
    {
        try {
            $agenda = new Agenda($this->app->config('config'));
            $agenda->deletar([$agenda->c[0] => $c0]);
            $this->app->flash('status', 'Sucesso ao excluir o agendamento!');
        } catch (\Exception $e) {
            $this->app->flash('status', $e->getMessage());
        }

        $this->app->redirect('/l/agenda/visualizar');
    }
}
