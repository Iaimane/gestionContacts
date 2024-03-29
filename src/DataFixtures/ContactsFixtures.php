<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Faker\Factory;
use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   $faker = Factory::create("fr_FR");

        $categories=[];
        
        $categorie = new Categorie();
        $categorie->setLibelle("Professionnel")
                  ->setDescription($faker->sentence(50))
                  ->setImage("https://picsum.photos/id/5/200/300");
        $manager->persist($categorie);
        $categories[]=$categorie;

        $categorie = new Categorie();
        $categorie->setLibelle("Sport")
        ->setDescription($faker->sentence(50))
        ->setImage("https://picsum.photos/id/73/200/300");
        $manager->persist($categorie);
        $categories[]=$categorie;

        $categorie = new Categorie();
        $categorie->setLibelle("Privé")
        ->setDescription($faker->sentence(50))
        ->setImage("https://picsum.photos/id/342/200/300");
        $manager->persist($categorie);
        $categories[]=$categorie;




        $genres = ["male","female"];

        for ($i=0 ; $i<100 ;$i++){ //boucle qui permet de générer 100 contacts, on integre le sexe parce qu'on a une condition qui doit être prise en compte autrement on aurait aléatoirement soit un homme soit une femme 
        $sexe = mt_rand(0,1);  // 50/50 pour le genre
        if ($sexe == 0) {
            $type = 'men';
        }else {
            $type = 'women';
        } //condition  pour savoir si c'est un homme ou une femme
        $contact = new Contact();
        $contact->setName($faker->lastName())
                ->setPrenom($faker->firstName($genres[$sexe]))
                ->setRue($faker->streetAddress())
                ->setCp($faker->numberBetween(01000,97000))
                ->setVille($faker->city())
                ->setMail($faker->email())
                ->setSexe($sexe)
                ->setCategory($categories[mt_rand(0,2)])
                ->setAvatar("https://randomuser.me/api/portraits/". $type."/".$i.".jpg"); //$i renvoit à la boucle plus haut qui génére les 100 contacts
                
        $manager->persist($contact); //on lui  dit que l'objet est en attente de coté avant qu'on lui donne l'ordre d'enregistrer dans la BDD
                
        }
        // $product = new Product();
        // $manager->persist($product); 
        // ci dessus les modèles d'exemples à utiliser pour lier des données avec la base de donnée, généré automatiquement

        $manager->flush(); // Pour enregistrer nos données (qui sont en persist) dans la BDD.
    }
}
