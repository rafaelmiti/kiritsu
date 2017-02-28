<?php
function trancar()
{
    global $app;

    !$app->getCookie('usuario')?: $_SESSION['usuario'] = $app->getCookie('usuario');

    try {
        \Config::trancar();
    } catch (\Exception $e) {
        $app->redirect('/');
    }
}
