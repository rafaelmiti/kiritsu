<?php
$I = new AcceptanceTester($scenario);

$I->wantTo('Log in');
$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->wantTo('See the agenda list');
$I->see('Kiritsu*');
$I->see('Agenda > Visualizar');
$I->seeNumberOfElements('tbody tr', 15);
$I->see('15 / 16');

$I->wantTo('Create a new record in the agenda');
$I->click('a[href="/l/agenda/cadastrar"]');
$I->submitForm('#agenda-cadastrar', [
    'categoria' => 'Teste',
    'atividade' => 'Atividade.',
    'data' => '2016-03-05',
    'hora' => '18:51',
    'periodico' => '0',
]);
$I->see('Sucesso ao cadastrar o agendamento!');

$I->wantTo('Check the list after the creation');
$I->see('Teste');
$I->see('Atividade.');
$I->see('05/03/2016');
$I->see('18:51');
$I->see('15 / 17');

$I->wantTo('Edit the created record');
$id = $I->grabTextFrom('//tbody/tr[1]/th');
$I->click("a[href='/l/agenda/editar/$id']");
$I->see("Agenda > Editar > #$id");
$I->submitForm('#agenda-editar', [
    'categoria' => 'Teste 2',
    'atividade' => 'Atividade 2.',
    'data' => '2016-03-06',
    'hora' => '19:22',
    'periodico' => '1',
]);
$I->see('Sucesso ao editar o agendamento!');

$I->wantTo('Check the list after the edition');
$I->click('a[href="/l/agenda/visualizar"]');
$I->see('Teste 2');
$I->see('Atividade 2.');
$I->see('06/03/2016');
$I->see('19:22');

$I->wantTo('Delete the created record');
$I->click("a[href='/l/agenda/excluir/$id']");
$I->see('Sucesso ao excluir o agendamento!');

$I->wantTo('Check the list after the deletion');
$I->dontSee('Teste');
$I->see('15 / 16');
