<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Visualizar a lista');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->click('a[href="/l/chuva/visualizar-grafico"]');
$I->seeNumberOfElements('tbody td', 731);
$I->seeElement('#2016-11-15', ['style' => 'background-color: darkblue']);
