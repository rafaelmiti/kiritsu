<?php
namespace Controller;

class IndexController
{
    private $app;

    public function __construct()
    {
        global $app;
        $this->app = $app;
    }

    public function get()
    {
        $this->app->render('usuario/login.php', ['app' => $this->app]);
    }
}
