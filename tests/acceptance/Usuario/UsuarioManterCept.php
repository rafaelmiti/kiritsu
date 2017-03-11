<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Logar com o sistema lembrando-se de mim');

$I->amOnPage('/');
$I->see('Login');

$I->seeCheckboxIsChecked('#manter');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->see('Agenda > Visualizar');
$I->seeCookie('usuario');
