<?php

namespace App\Tests\Controller\Contact;

use App\Factory\ContactFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function _before(ControllerTester $I)
    {
    }

    /*
     * Test pour l'action index() du ContactController
     * */
    public function bonNombreDeContactsDansLaListe(ControllerTester $I)
    {
        ContactFactory::createMany(195);

        $I->amOnPage('/contact');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Liste des contacts');
        $I->see('Liste des contacts', 'h1');
        $I->seeNumberOfElements('ul.contacts > li > a', 195);
    }

    public function contactList(ControllerTester $I)
    {
        ContactFactory::createOne([/* 'id' => 1, */ 'firstname' => 'Joe', 'lastname' => 'Aaaaaaaaaaaaaaa']);
        ContactFactory::createMany(5);

        $I->amOnPage('/contact');
        $I->click('Aaaaaaaaaaaaaaa, Joe');
        $I->seeResponseCodeIs(200);
        $I->seeCurrentRouteIs('contact_show', ['id' => 1]);
    }

    public function listeDesContactsCorrectemmentTries(ControllerTester $I)
    {
        ContactFactory::createSequence([
            ['firstName' => 'Alain', 'lastName' => 'Riand'],
            ['firstName' => 'Zoe', 'lastName' => 'Fautz'],
            ['firstName' => 'Bruno', 'lastName' => 'Gar'],
            ['firstName' => 'Ulysse', 'lastName' => 'Voume'],
        ]);

        $I->amOnPage('/contact');

        $I->assertEquals(
            $I->grabMultiple('ul.contacts > li > a'),
            [
                'Fautz, Zoe',
                'Gar, Bruno',
                'Riand, Alain',
                'Voume, Ulysse',
            ]);
    }
}
