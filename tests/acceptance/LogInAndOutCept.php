<?php
$I = new AcceptanceTester($scenario);

$I->wantTo('See the login page');
$I->amOnPage('/');
$I->see('Login');

$I->wantTo('Fail at a sql injection invasion');
$I->fillField('Nome', '"');
$I->fillField('Senha', '\'');
$I->click('Login');
$I->see('Falha na autenticação');

$I->wantTo('Log in and that the system remember me');
$I->seeCheckboxIsChecked('#manter');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');
$I->see('Agenda > Visualizar');
$I->seeCookie('usuario');

$I->wantTo('Check the redirect from the home page when im already logged in');
$I->amOnPage('/');
$I->see('Agenda > Visualizar');

$I->wantTo('Log out');
$I->click('a[href="/logout"]');
$I->dontSee('Agenda > Visualizar');

$I->wantTo('Check the redirect from inside the system when im logged out');
$I->amOnPage('/l/agenda/visualizar');
$I->dontSee('Agenda > Visualizar');

$I->wantTo('Log in and that the system do not remember me');
$I->uncheckOption('#manter');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');
$I->see('Agenda > Visualizar');
$I->dontSeeCookie('usuario');
