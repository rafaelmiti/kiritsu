<?php
session_start();
ini_set('display_errors', 1);

$config = [];

$config['salt'] = '$1$mitipess$';

$config['banco']['charset'] = 'utf8';
$config['banco']['servidor'] = 'localhost';
$config['banco']['usuario'] = 'root';
$config['banco']['senha'] = 'root';
$config['banco']['nome'] = 'miti_pessoal';

$config['rest']['servidor'] = 'http://kiritsu.localhost';

require_once '../vendor/autoload.php';
