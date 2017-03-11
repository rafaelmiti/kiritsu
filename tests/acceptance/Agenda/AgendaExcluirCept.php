<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Excluir um registro');

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

$I->click("a[href='/l/agenda/excluir/$id']");

$I->see('Sucesso ao excluir o agendamento!');
$I->dontSee('Teste');
$I->see('15 / 16');
