<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Ser redirecionado para dentro do sistema quando estiver logado');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$I->amOnPage('/');
$I->see('Kiritsu*');
