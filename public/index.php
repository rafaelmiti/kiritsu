<?php
require_once '../Config.php';
require_once '../src/Middleware/Auth.php';
try{$config = (new \Config)->getConfig();}catch(\Exception $ex){exit($ex->getMessage());}

$app = new \Slim\Slim(['config' => $config, 'debug' => $config['ambiente'], 'templates.path' => '../src/view/']);
$app->response->headers->set('Content-Type', "text/html; charset={$config['charset']}");

$app->get('/', '\Controller\Index:get');

$app->post('/login', '\Controller\Usuario:postLogin');
$app->get('/logout', '\Controller\Usuario:getLogout');

$app->group('/l', '\trancar', function() use($app){
	$app->group('/inspiracao', function() use($app){
		$app->get('/visualizar/:id', '\Controller\Inspiracao:getVisualizar');
	});
	
	$app->group('/historico', function() use($app){
		$app->get('/visualizar', '\Controller\Historico:getVisualizar');
		$app->get('/buscar', '\Controller\Historico:getBuscar');
		$app->get('/editar/:id', '\Controller\Historico:getEditar');
		$app->post('/editar/:id', '\Controller\Historico:postEditar');
		$app->get('/agendar/:id', '\Controller\Historico:getAgendar');
		$app->get('/excluir/:id', '\Controller\Historico:getExcluir');
	});
	
	$app->group('/agenda', function() use($app){
		$app->get('/visualizar', '\Controller\Agenda:getVisualizar');
		$app->get('/cadastrar', '\Controller\Agenda:getCadastrar');
		$app->post('/cadastrar', '\Controller\Agenda:postCadastrar');
		$app->get('/editar/:id', '\Controller\Agenda:getEditar');
		$app->post('/editar/:id', '\Controller\Agenda:postEditar');
		$app->get('/historiar/:id', '\Controller\Agenda:getHistoriar');
		$app->get('/excluir/:id', '\Controller\Agenda:getExcluir');
	});
	
	$app->group('/memoria', function() use($app){
		$app->get('/visualizar', '\Controller\Memoria:getVisualizar');
		$app->get('/buscar', '\Controller\Memoria:getBuscar');
		$app->get('/cadastrar', '\Controller\Memoria:getCadastrar');
		$app->post('/cadastrar', '\Controller\Memoria:postCadastrar');
		$app->get('/editar/:id', '\Controller\Memoria:getEditar');
		$app->post('/editar/:id', '\Controller\Memoria:postEditar');
		$app->get('/excluir/:id', '\Controller\Memoria:getExcluir');
	});
    
    $app->group('/chuva', function() use($app){
		$app->get('/visualizar', '\Controller\Chuva:getVisualizar');
		$app->get('/visualizar-grafico', '\Controller\Chuva:getVisualizarGrafico');
		$app->get('/cadastrar', '\Controller\Chuva:getCadastrar');
		$app->post('/cadastrar', '\Controller\Chuva:postCadastrar');
		$app->get('/editar/:id', '\Controller\Chuva:getEditar');
		$app->post('/editar/:id', '\Controller\Chuva:postEditar');
		$app->get('/excluir/:id', '\Controller\Chuva:getExcluir');
	});
});

$app->run();
