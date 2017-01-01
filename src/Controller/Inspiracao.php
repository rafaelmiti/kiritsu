<?php
namespace Controller;

class Inspiracao
{
    private $app;

    public function __construct()
    {
        global $app;
        $this->app = $app;
    }

    public function getVisualizar($id)
    {
        try {
            $inspiracao = new \Model\Inspiracao($this->app->config('config'));
            $i = $inspiracao->ler(['id' => $id])->vetorizar();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            return;
        }

        $this->app->response->headers->set('Content-Type', 'image/jpeg');
        echo $i['imagem'];
    }
}
