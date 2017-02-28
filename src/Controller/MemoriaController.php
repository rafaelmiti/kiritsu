<?php
namespace Controller;

class MemoriaController
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
            $memoria = new \Model\Memoria($this->app->config('config'));
            $banco = $memoria->paginar($_GET, 15, $pagina);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }

        $this->app->render('memoria/visualizar.php', ['app' => $this->app, 'memoria' => $memoria, 'banco' => $banco]);
    }

    public function getBuscar()
    {
        $this->app->render('memoria/buscar.php', ['app' => $this->app]);
    }

    public function getCadastrar()
    {
        $memoria = new \Model\Memoria($this->app->config('config'));
        $this->app->render('memoria/cadastrar.php', ['app' => $this->app, 'memoria' => $memoria]);
    }

    public function postCadastrar()
    {
        try {
            $memoria = new \Model\Memoria($this->app->config('config'));
            $memoria->criar($_POST);
            $this->app->flash('status', 'Sucesso ao cadastrar a memória!');
        } catch (\Exception $ex) {
            $this->app->flashNow('status', $ex->getMessage());
            $this->app->render('memoria/cadastrar.php', ['app' => $this->app]);
            $this->app->stop();
        }

        $this->app->redirect("/l/memoria/visualizar");
    }

    public function getEditar($id)
    {
        try {
            $memoria = new \Model\Memoria($this->app->config('config'));
            $m = $memoria->ler(['id' => $id])->vetorizar();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }

        $m = \Miti\Tratamento::escapar($m);

        $this->app->render('memoria/editar.php', ['app' => $this->app, 'memoria' => $memoria, 'm' => $m]);
    }

    public function postEditar($id)
    {
        $_POST['id'] = $id;

        try {
            $memoria = new \Model\Memoria($this->app->config('config'));
            $memoria->atualizar($_POST);
            $this->app->flash('status', 'Sucesso ao editar a memória!');
        } catch (\Exception $ex) {
            $this->app->flash('status', $ex->getMessage());
        }

        $this->app->redirect("/l/memoria/editar/$id");
    }

    public function getExcluir($id)
    {
        try {
            $memoria = new \Model\Memoria($this->app->config('config'));
            $memoria->deletar(['id' => $id]);
            $this->app->flash('status', 'Sucesso ao excluir a memória!');
        } catch (\Exception $ex) {
            $this->app->flash('status', $ex->getMessage());
        }

        $this->app->redirect('/l/memoria/visualizar');
    }
}
