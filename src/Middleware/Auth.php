<?php
function trancar()
{
    global $app;

    try {
        \Config::trancar();
    } catch (\Exception $e) {
        $app->redirect('/login');
    }
}
