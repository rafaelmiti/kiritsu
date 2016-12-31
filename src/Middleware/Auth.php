<?php
function trancar(){
	global $app;
	if($app->getCookie('usuario')){$_SESSION['usuario'] = $app->getCookie('usuario');}
	try{\Config::trancar();}catch(\Exception $ex){$app->redirect('/');}
}
