<?php
require_once '../Config.php';
require_once '../src/Middleware/Auth.php';

try {
    $config = (new \Config)->getConfig();
} catch (\Exception $e) {
    exit($e->getMessage());
}

$app = new \Slim\Slim(['config' => $config, 'debug' => $config['ambiente'], 'templates.path' => '../src/view/']);
$app->response->headers->set('Content-Type', "text/html; charset={$config['charset']}");

$app->get('/', 'Controller\IndexController:get');

$app->get('/login', 'Controller\UsuarioController:getLogin');
$app->post('/login', 'Controller\UsuarioController:postLogin');
$app->get('/logout', 'Controller\UsuarioController:getLogout');

$app->group('/l', '\trancar', function() use($app) {
    $app->group('/inspiracao', function() use($app) {
        $app->get('/visualizar/:id', 'Controller\InspiracaoController:getVisualizar');
    });

    $app->group('/historico', function() use($app) {
        $app->get('/visualizar', 'Controller\HistoricoController:getVisualizar');
        $app->get('/buscar', 'Controller\HistoricoController:getBuscar');
        $app->get('/editar/:id', 'Controller\HistoricoController:getEditar');
        $app->post('/editar/:id', 'Controller\HistoricoController:postEditar');
        $app->get('/agendar/:id', 'Controller\HistoricoController:getAgendar');
        $app->get('/excluir/:id', 'Controller\HistoricoController:getExcluir');
    });

    $app->group('/agenda', function() use($app) {
        $app->get('/visualizar', 'Controller\AgendaController:getVisualizar');
        $app->get('/cadastrar', 'Controller\AgendaController:getCadastrar');
        $app->post('/cadastrar', 'Controller\AgendaController:postCadastrar');
        $app->get('/editar/:id', 'Controller\AgendaController:getEditar');
        $app->post('/editar/:id', 'Controller\AgendaController:postEditar');
        $app->get('/historiar/:id', 'Controller\AgendaController:getHistoriar');
        $app->get('/excluir/:id', 'Controller\AgendaController:getExcluir');
    });

    $app->group('/memoria', function() use($app) {
        $app->get('/visualizar', 'Controller\MemoriaController:getVisualizar');
        $app->get('/buscar', 'Controller\MemoriaController:getBuscar');
        $app->get('/cadastrar', 'Controller\MemoriaController:getCadastrar');
        $app->post('/cadastrar', 'Controller\MemoriaController:postCadastrar');
        $app->get('/editar/:id', 'Controller\MemoriaController:getEditar');
        $app->post('/editar/:id', 'Controller\MemoriaController:postEditar');
        $app->get('/excluir/:id', 'Controller\MemoriaController:getExcluir');
    });

    $app->group('/chuva', function() use($app) {
        $app->get('/visualizar', 'Controller\ChuvaController:getVisualizar');
        $app->get('/visualizar-grafico', 'Controller\ChuvaController:getVisualizarGrafico');
        $app->get('/cadastrar', 'Controller\ChuvaController:getCadastrar');
        $app->post('/cadastrar', 'Controller\ChuvaController:postCadastrar');
        $app->get('/editar/:id', 'Controller\ChuvaController:getEditar');
        $app->post('/editar/:id', 'Controller\ChuvaController:postEditar');
        $app->get('/excluir/:id', 'Controller\ChuvaController:getExcluir');
    });
});

$app->run();
