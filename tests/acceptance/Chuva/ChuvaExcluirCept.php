<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Excluir um registro');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->click('a[href="/l/chuva/cadastrar"]');

$I->submitForm('#chuva-cadastrar', [
    'data' => '2020-12-31',
    'intensidade' => '1',
]);

$I->see('31/12/2020');
$id = $I->grabTextFrom('//tbody/tr[1]/th');

$I->click("a[href='/l/chuva/excluir/$id']");

$I->see('Sucesso ao excluir a chuva');
$I->dontSee('Teste');
$I->see('15 / 731');
