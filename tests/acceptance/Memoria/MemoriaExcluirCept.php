<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Excluir um registro');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->click('a[href="/l/memoria/cadastrar"]');

$I->submitForm('#memoria-cadastrar', [
    'categoria' => '17',
    'sub_categoria' => 'Teste',
    'descricao' => 'Descrição.',
]);

$I->see('Teste');
$id = $I->grabTextFrom('//tbody/tr[1]/th');

$I->click("a[href='/l/memoria/excluir/$id']");

$I->see('Sucesso ao excluir a memória');
$I->dontSee('Teste');
$I->see('15 / 268');
