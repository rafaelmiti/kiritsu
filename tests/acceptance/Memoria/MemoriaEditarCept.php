<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Editar um registro');

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
$I->canSee("Memória > Editar > #$id");

$I->submitForm('#memoria-editar', [
    'categoria' => '5',
    'sub_categoria' => 'Teste 2',
    'descricao' => 'Descrição 2.',
]);

$I->canSee('Sucesso ao editar a memória');

$I->click('a[href="/l/memoria/visualizar"]');
$I->canSee('Git');
$I->canSee('Teste 2');
$I->canSee('Descrição 2.');

$I->click("a[href='/l/memoria/excluir/$id']");
