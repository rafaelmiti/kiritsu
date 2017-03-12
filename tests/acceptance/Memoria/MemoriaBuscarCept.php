<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Realizar uma busca');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->click('a[href="/l/memoria/buscar"]');

$I->see('Memória > Buscar');

$I->submitForm('#memoria-buscar', [
    'categoria' => '21',
    'sub_categoria' => 'boi',
    'descricao' => '9106',
]);

$I->see('Memória > Visualizar');
$I->see('253');
$I->see('Telefone');
$I->see('Boi');
$I->see('9106-4993');
