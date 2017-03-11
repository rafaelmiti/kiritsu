<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Ver uma mensagem de erro amigável em uma tentativa de sql injection');

$I->amOnPage('/');
$I->fillField('Nome', '"');
$I->fillField('Senha', '\'');
$I->click('Login');

$I->see('Falha na autenticação');
