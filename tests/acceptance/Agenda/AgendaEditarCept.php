<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Editar um registro');

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
$I->canSee("Agenda > Editar > #$id");

$I->submitForm('#agenda-editar', [
    'categoria' => 'Teste 2',
    'atividade' => 'Atividade 2.',
    'data' => '2016-03-06',
    'hora' => '19:22',
    'periodico' => '1',
]);

$I->canSee('Sucesso ao editar o agendamento');

$I->click('a[href="/l/agenda/visualizar"]');
$I->canSee('Teste 2');
$I->canSee('Atividade 2.');
$I->canSee('06/03/2016');
$I->canSee('19:22');

$I->click("a[href='/l/agenda/excluir/$id']");
