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

$I->click('//tbody/tr[1]/td[last()]/a[1]');
$I->canSee('Agenda > Cadastrar');
$I->canSeeInField('categoria', 'Teste');
$I->canSeeInField('atividade', '');
$I->canSeeInField('data', '2016-03-05');
$I->canSeeInField('hora', '18:51:00');
$I->canSeeOptionIsSelected('periodico', 'Sim');

$I->click('a[href="/l/agenda/visualizar"]');

$id = $I->grabTextFrom('//tbody/tr[1]/th');
$I->click("a[href='/l/agenda/excluir/$id']");
