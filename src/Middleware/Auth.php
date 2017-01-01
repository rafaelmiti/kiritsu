<?php
function trancar()
{
    global $app;

    !$app->getCookie('usuario')?: $_SESSION['usuario'] = $app->getCookie('usuario');

    try {
        \Config::trancar();
    } catch (\Exception $ex) {
        $app->redirect('/');
    }
}
