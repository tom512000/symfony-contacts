<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $rep): Response
    {
        $contacts = $rep->findBy([], ['lastname' => 'ASC', 'firstname' => 'ASC']);

        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts,
            'pageTitle' => 'Liste des contacts']);
    }

    #[Route('/contact/{contactId}', name: 'app_contact_show', requirements: ['contactId' => '\d+'])]
    public function show(int $contactId, ContactRepository $rep): Response
    {
        $contact = $rep->find($contactId);

        if (!$contact) {
            throw new NotFoundHttpException('Contact introuvable');
        }

        return $this->render('contact/show.html.twig', [
            'contact' => $contact,
        ]);
    }
}
