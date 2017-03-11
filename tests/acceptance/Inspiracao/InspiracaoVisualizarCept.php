<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Visualizar a imagem');

$I->amOnPage('/');
$I->fillField('Nome', 'admin');
$I->fillField('Senha', '123');
$I->click('Login');

$src = $I->grabAttributeFrom('#inspiracao', 'src');

$I->amOnPage($src);
$I->seeResponseCodeIs(200);
