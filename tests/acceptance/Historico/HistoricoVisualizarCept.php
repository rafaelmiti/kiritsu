<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Visualizar a lista');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->click('a[href="/l/historico/visualizar"]');

$I->see('Histórico > Visualizar');
$I->seeNumberOfElements('tbody tr', 15);
$I->see('15 / 16');
