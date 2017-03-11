<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Logar sem o sistema lembrar de mim');

$I->amOnPage('/');
$I->see('Login');

$I->uncheckOption('#manter');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->see('Agenda > Visualizar');
$I->dontSeeCookie('usuario');
