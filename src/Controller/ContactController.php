<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $rep, Request $request): Response
    {
        $search = $request->query->get('search', '');

        $contacts = $rep->search($search);

        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts,
            'pageTitle' => 'Liste des contacts']);
    }

    #[Route('/contact/{id}', name: 'contact_show', requirements: ['contact' => '\d+'])]
    public function show(Contact $contact): Response
    {
        return $this->render('contact/show.html.twig', [
            'contact' => $contact]);
    }
}
