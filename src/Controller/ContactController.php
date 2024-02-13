<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contacts", name="app_contact", methods={"GET"})  
     */


     //ci dessus la route /contact, suivi de 2 paramètres name="app_contact" et et methods={"GET"}
   
    public function index(ContactRepository  $repo) : Response 
    
    {
        // $manager = $this->getDoctrine()->getManager(); //manager gère l'envoi des éléments vers la BDD et getDoctrine fait le taxi
        // $repo = $manager->getRepository(Contact::class); // On récupère le repository de la table "Contact"
        // les deux lignes au dessus sont remplacées par les paramètres de notre fonction index
        $contacts = $repo->findAll();
        // les 3 lignes au dessus récupèrent tous les contacts de la base de données et les stockent dans une variable "contacts". 
        // dump($contacts); équivalent du console log on peut voir dans le profiler
        return $this->render('contact/listeContacts.html.twig', [ // on utilise la vue listeContacts.html.twig pour afficher le contenu, renvoi un tableau avec tous les contacts
            // 'controller_name' => 'ContactController',
            "contacts"=>$contacts, //"contacts" est le nom de la variable qui sera utilisée dans notre vue twig (front)
            //$contacts, variable back end 
            //on instancie une variable "contacts" à laquelle on rattache le contenu de la variable $contacts (back)
            // pour pouvoir utiliser en twig car le $contacts ne s'affiche pas en twig 
            //on les relie donc ensemble
        ]);
    }

    /**
     * @Route("/contact/{id}", name="ficheContact", methods={"GET"})  
     */
    
    public function ficheContact($id, ContactRepository $repo) : Response 
    {

        $contact = $repo->find($id);
        return $this->render('contact/ficheContact.html.twig', [
            'contact' => $contact

        ]);
    } 
} 



