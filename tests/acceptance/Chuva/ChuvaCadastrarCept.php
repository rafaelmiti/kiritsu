<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Cadastrar um registro');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->click('a[href="/l/chuva/cadastrar"]');

$I->submitForm('#chuva-cadastrar', [
    'data' => '2020-12-31',
    'intensidade' => '1',
]);

$I->canSee('Sucesso ao cadastrar a chuva');
$I->canSee('31/12/2020');
$I->canSee('1', '//tbody/tr[1]/td[2]');
$I->canSee('15 / 732');

$id = $I->grabTextFrom('//tbody/tr[1]/th');
$I->click("a[href='/l/chuva/excluir/$id']");
