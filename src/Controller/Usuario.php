<?php
namespace Controller;

class Usuario
{
    private $app;

    public function __construct()
    {
        global $app;
        $this->app = $app;
    }

    public function postLogin()
    {
        try {
            (new \Model\Usuario($this->app->config('config')))->login($_POST);
            !isset($_POST['manter'])?: $this->app->setCookie('usuario', $_SESSION['usuario'], '1 month');
            $this->app->redirect('/l/agenda/visualizar');
        } catch (\Exception $ex) {
            $this->app->flashNow('status', $ex->getMessage());
            $this->app->render('usuario/login.php', ['app' => $this->app]);
        }
    }

    public function getLogout()
    {
        (new \Model\Usuario($this->app->config('config')))->logout();
        !$this->app->getCookie('usuario')?: $this->app->deleteCookie('usuario');
        $this->app->redirect('/');
    }
}
