<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Ver um erro na edição');

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

$id = $I->grabTextFrom('//tbody/tr[1]/th');

$I->click("a[href='/l/memoria/editar/$id']");

$I->submitForm('#memoria-editar', [
    'categoria' => '',
    'sub_categoria' => 'Teste 2',
    'descricao' => 'Descrição 2.',
]);

$I->canSee("Valor vazio para o campo 'categoria'.");

$I->click('a[href="/l/memoria/visualizar"]');
$I->click("a[href='/l/memoria/excluir/$id']");
