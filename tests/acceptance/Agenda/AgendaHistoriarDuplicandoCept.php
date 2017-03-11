<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Historiar duplicando um registro');

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
    'periodico' => '1',
]);

$id = $I->grabTextFrom('//tbody/tr[1]/th');

$I->click('//tbody/tr[1]/td[last()]/a[1]');
$I->see('Agenda > Cadastrar');
$I->seeInField('categoria', 'Teste');
$I->seeInField('atividade', '');
$I->seeInField('data', '2016-03-05');
$I->seeInField('hora', '18:51:00');
$I->seeOptionIsSelected('periodico', 'Sim');

$I->click('a[href="/l/agenda/visualizar"]');
$I->click("a[href='/l/agenda/excluir/$id']");
