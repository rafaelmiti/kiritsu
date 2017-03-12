<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Cadastrar um registro');

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

$I->canSee('Sucesso ao cadastrar a memória');
$I->canSee('PHP');
$I->canSee('Teste');
$I->canSee('Descrição.');
$I->canSee('15 / 269');

$id = $I->grabTextFrom('//tbody/tr[1]/th');
$I->click("a[href='/l/memoria/excluir/$id']");
