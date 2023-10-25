<?php

namespace App\Tests\Controller\Contact;

use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function _before(ControllerTester $I)
    {
    }

    // Test pour l'action index() du ContactController
    public function testIndexPage(ControllerTester $I)
    {
        // Accéder à la page /contact
        $I->amOnPage('/contact');

        // Vérifier que la réponse HTTP est 200 (OK)
        $I->seeResponseCodeIs(200);

        // Vérifier que le titre de la page contient "Liste des contacts"
        $I->seeInTitle('Liste des contacts');

        // Vérifier qu'un titre de niveau 1 contenant "Liste des contacts" est présent
        $I->see('Liste des contacts', 'h1');

        // Vérifier qu'une liste à puce contient 195 éléments
        $I->seeNumberOfElements('ul li', 195);
    }
}
