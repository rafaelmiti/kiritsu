<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Sair do sistema');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->click('a[href="/logout"]');
$I->dontSee('Agenda > Visualizar');

$I->amOnPage('/l/agenda/visualizar');
$I->dontSee('Agenda > Visualizar');
