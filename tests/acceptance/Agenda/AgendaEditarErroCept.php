<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Ver um erro na edição');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->click('a[href="/l/agenda/cadastrar"]');

$I->submitForm('#agenda-cadastrar', [
    'categoria' => 'Teste',
    'atividade' => 'Atividade.',
    'data' => '2016-03-05',
    'hora' => '18:51',
    'periodico' => '0',
]);

$id = $I->grabTextFrom('//tbody/tr[1]/th');

$I->click("a[href='/l/agenda/editar/$id']");

$I->submitForm('#agenda-editar', [
    'categoria' => '',
    'atividade' => 'Atividade 2.',
    'data' => '2016-03-06',
    'hora' => '19:22',
    'periodico' => '1',
]);

$I->see("Valor vazio para o campo 'categoria'.");

$I->click('a[href="/l/agenda/visualizar"]');
$I->click("a[href='/l/agenda/excluir/$id']");
