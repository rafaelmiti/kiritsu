<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Editar um registro');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->click('a[href="/l/chuva/cadastrar"]');

$I->submitForm('#chuva-cadastrar', [
    'data' => '2020-12-31',
    'intensidade' => '1',
]);

$id = $I->grabTextFrom('//tbody/tr[1]/th');

$I->click("a[href='/l/chuva/editar/$id']");
$I->canSee("Chuva > Editar > #$id");

$I->submitForm('#chuva-editar', [
    'data' => '2020-12-30',
    'intensidade' => '2',
]);

$I->canSee('Sucesso ao editar a chuva');

$I->click('a[href="/l/chuva/visualizar"]');
$I->canSee('30/12/2020');
$I->canSee('2', '//tbody/tr[1]/td[2]');

$I->click("a[href='/l/chuva/excluir/$id']");
