<?php
namespace Controller;

use Model\Chuva;

class ChuvaController
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
            $chuva = new Chuva($this->app->config('config'));
            $banco = $chuva->paginar($_GET, 'desc', 15, $pagina);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $this->app->render('chuva/visualizar.php', ['app' => $this->app, 'chuva' => $chuva, 'banco' => $banco]);
    }

    public function getVisualizarGrafico()
    {
        try {
            $chuva = new Chuva($this->app->config('config'));
            $banco = $chuva->paginar();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $this->app->render('chuva/visualizar-grafico.php', ['app' => $this->app, 'banco' => $banco]);
    }

    public function getCadastrar()
    {
        $this->app->render('chuva/cadastrar.php', ['app' => $this->app]);
    }

    public function postCadastrar()
    {
        try {
            $chuva = new Chuva($this->app->config('config'));
            $chuva->criar($_POST);
            
            $this->app->flash('status', 'ok');
            $this->app->flash('message', 'Sucesso ao cadastrar a chuva');
        } catch (\Exception $e) {
            $this->app->flashNow('status', 'nok');
            $this->app->flashNow('message', $e->getMessage());
            
            $this->app->render('chuva/cadastrar.php', ['app' => $this->app]);
            $this->app->stop();
        }

        $this->app->redirect("/l/chuva/visualizar");
    }

    public function getEditar($id)
    {
        try {
            $chuva = new Chuva($this->app->config('config'));
            $c = $chuva->ler(['id' => $id])->vetorizar();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $c = \Miti\Tratamento::escapar($c);

        $this->app->render('chuva/editar.php', ['app' => $this->app, 'c' => $c]);
    }

    public function postEditar($id)
    {
        $_POST['id'] = $id;

        try {
            $chuva = new Chuva($this->app->config('config'));
            $chuva->atualizar($_POST);
            
            $this->app->flash('status', 'ok');
            $this->app->flash('message', 'Sucesso ao editar a chuva');
        } catch (\Exception $e) {
            $this->app->flash('status', 'nok');
            $this->app->flash('message', $e->getMessage());
        }

        $this->app->redirect("/l/chuva/editar/$id");
    }

    public function getExcluir($id)
    {
        try {
            $chuva = new Chuva($this->app->config('config'));
            $chuva->deletar(['id' => $id]);
            
            $this->app->flash('status', 'ok');
            $this->app->flash('message', 'Sucesso ao excluir a chuva');
        } catch (\Exception $e) {
            $this->app->flash('status', 'nok');
            $this->app->flash('message', $e->getMessage());
        }

        $this->app->redirect('/l/chuva/visualizar');
    }
}
