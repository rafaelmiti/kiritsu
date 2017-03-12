<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Ver um erro no cadastro');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->click('a[href="/l/memoria/cadastrar"]');

$I->submitForm('#memoria-cadastrar', [
    'categoria' => '',
    'sub_categoria' => 'Teste',
    'descricao' => 'Descrição.',
]);

$I->see("Valor vazio para o campo 'categoria'.");
