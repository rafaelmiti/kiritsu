<?php
namespace Controller;

class Chuva
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
            $chuva = new \Model\Chuva($this->app->config('config'));
            $banco = $chuva->paginar($_GET, 'desc', 15, $pagina);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }

        $this->app->render('chuva/visualizar.php', ['app' => $this->app, 'chuva' => $chuva, 'banco' => $banco]);
    }

    public function getVisualizarGrafico()
    {
        try {
            $chuva = new \Model\Chuva($this->app->config('config'));
            $banco = $chuva->paginar();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
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
            $chuva = new \Model\Chuva($this->app->config('config'));
            $chuva->criar($_POST);
            $this->app->flash('status', 'Sucesso ao cadastrar a chuva!');
        } catch (\Exception $ex) {
            $this->app->flashNow('status', $ex->getMessage());
            $this->app->render('chuva/cadastrar.php', ['app' => $this->app]);
            $this->app->stop();
        }

        $this->app->redirect("/l/chuva/visualizar");
    }

    public function getEditar($id)
    {
        try {
            $chuva = new \Model\Chuva($this->app->config('config'));
            $c = $chuva->ler(['id' => $id])->vetorizar();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }

        $c = \Miti\Tratamento::escapar($c);

        $this->app->render('chuva/editar.php', ['app' => $this->app, 'c' => $c]);
    }

    public function postEditar($id)
    {
        $_POST['id'] = $id;

        try {
            $chuva = new \Model\Chuva($this->app->config('config'));
            $chuva->atualizar($_POST);
            $this->app->flash('status', 'Sucesso ao editar a chuva!');
        } catch (\Exception $ex) {
            $this->app->flash('status', $ex->getMessage());
        }

        $this->app->redirect("/l/chuva/editar/$id");
    }

    public function getExcluir($id)
    {
        try {
            $chuva = new \Model\Chuva($this->app->config('config'));
            $chuva->deletar(['id' => $id]);
            $this->app->flash('status', 'Sucesso ao excluir a chuva!');
        } catch (\Exception $ex) {
            $this->app->flash('status', $ex->getMessage());
        }

        $this->app->redirect('/l/chuva/visualizar');
    }
}
