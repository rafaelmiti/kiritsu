<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Historiar um registro');

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

$id = $I->grabTextFrom('//tbody/tr[1]/th');

$I->click("a[href='/l/agenda/historiar/$id']");
$I->see('Sucesso ao historiar o agendamento!');

$I->amOnPage("/l/historico/visualizar?historia=1&pagina=2");
$I->see($id);
$I->see('Teste');

$I->click("a[href='/l/historico/excluir/$id']");
