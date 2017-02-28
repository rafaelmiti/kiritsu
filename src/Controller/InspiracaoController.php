<?php
namespace Controller;

use Model\Inspiracao;

class InspiracaoController
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
            $inspiracao = new Inspiracao($this->app->config('config'));
            $i = $inspiracao->ler(['id' => $id])->vetorizar();
        } catch (\Exception $e) {
            echo $e->getMessage();
            return;
        }

        $this->app->response->headers->set('Content-Type', 'image/jpeg');
        echo $i['imagem'];
    }
}
