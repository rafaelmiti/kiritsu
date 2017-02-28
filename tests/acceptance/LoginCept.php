<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('see the login page');
$I->amOnPage('/');
$I->see('Login');
