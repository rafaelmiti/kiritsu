<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Cadastrar um registro');

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

$I->canSee('Sucesso ao cadastrar o agendamento');
$I->canSee('Teste');
$I->canSee('Atividade.');
$I->canSee('05/03/2016');
$I->canSee('18:51');
$I->canSee('15 / 17');

$id = $I->grabTextFrom('//tbody/tr[1]/th');
$I->click("a[href='/l/agenda/excluir/$id']");
