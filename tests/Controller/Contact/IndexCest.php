<?php

namespace App\Tests\Controller\Contact;

use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function _before(ControllerTester $I)
    {
    }

    /*
     * Test pour l'action index() du ContactController
     * */
    public function testIndexPage(ControllerTester $I)
    {
        $I->amOnPage('/contact');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Liste des contacts');
        $I->see('Liste des contacts', 'h1');
        $I->seeNumberOfElements('ul li', 195);
        $I->seeNumberOfElements('ul li a', 195);
    }

    public function testContactList(ControllerTester $I)
    {
        $I->amOnPage('/contact');
        $I->click('ul li a:first-child');
        $I->seeCurrentRouteIs('contact_show');
    }
}
