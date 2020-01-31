<?php
namespace Controller;

class UsuarioController
{
    private $app;

    public function __construct()
    {
        global $app;
        $this->app = $app;
    }

    public function getLogin()
    {
        $this->app->render('usuario/login.php', ['app' => $this->app]);
    }
    
    public function postLogin()
    {
        try {
            (new \Model\Usuario($this->app->config('config')))->login($_POST);
            $this->app->redirect('/l/agenda/visualizar');
        } catch (\Exception $ex) {
            $this->app->flashNow('status', 'nok');
            $this->app->flashNow('message', $ex->getMessage());
            
            $this->app->render('usuario/login.php', ['app' => $this->app]);
        }
    }

    public function getLogout()
    {
        (new \Model\Usuario($this->app->config('config')))->logout();
        $this->app->redirect('/');
    }
}
