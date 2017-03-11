<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Realizar uma busca');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->click('a[href="/l/historico/buscar"]');

$I->see('Histórico > Buscar');

$I->submitForm('#historico-buscar', [
    'categoria' => 'mobi',
    'atividade' => 'chatbot',
    'data' => '2016-11-30',
]);

$I->see('Histórico > Visualizar');
$I->see('888');
$I->see('conta.MOBI');
$I->see('entrada: 09:36; chatbot: entendimento do processo de atualização;');
$I->see('30/11/2016');
$I->see('Qua');
$I->see('19:54');
