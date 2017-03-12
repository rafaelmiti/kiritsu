<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Visualizar a lista');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->click('a[href="/l/memoria/visualizar"]');

$I->see('Memória > Visualizar');
$I->seeNumberOfElements('tbody tr', 15);
$I->see('15 / 268');
