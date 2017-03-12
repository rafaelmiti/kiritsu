<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Excluir um registro');

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
    'periodico' => '0',
]);

$I->see('Teste');
$id = $I->grabTextFrom('//tbody/tr[1]/th');

$I->click("a[href='/l/agenda/historiar/$id']");

$I->amOnPage("/l/historico/visualizar?historia=1&pagina=2");
$I->click("a[href='/l/historico/excluir/$id']");
$I->see('Sucesso ao excluir a história');

$I->see('15 / 16');
$I->amOnPage("/l/historico/visualizar?historia=1&pagina=2");
$I->dontSee('Teste');
