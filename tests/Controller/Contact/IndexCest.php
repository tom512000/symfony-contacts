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

    public function contactCorrectementClickableEtUtilisable(ControllerTester $I)
    {
        ContactFactory::createOne(['firstname' => 'Joe', 'lastname' => 'Aaaaaaaaaaaaaaa']);
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

    public function chercheUnContactAvecLeFormulaire(ControllerTester $I)
    {
        ContactFactory::createSequence([
            ['firstName' => 'Alain', 'lastName' => 'Riand'],
            ['firstName' => 'Zoe', 'lastName' => 'Fautz'],
            ['firstname' => 'John', 'lastname' => 'Doe'],
            ['firstname' => 'Mickael', 'lastname' => 'John'],
        ]);

        $I->amOnPage('/contact');
        $I->fillField('search', 'John');
        $I->click('Rechercher');

        $I->seeResponseCodeIs(200);
        $I->seeNumberOfElements('ul.contacts > li > a', 2);
        $I->see('Doe, John');
    }
}
