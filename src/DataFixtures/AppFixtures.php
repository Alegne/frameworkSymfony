<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = \Faker\Factory::create('fr_FR');

        $fakerCategorie = \Faker\Factory::create();
        $fakerCategorie->addProvider(new \Bezhanov\Faker\Provider\Commerce($fakerCategorie));

        $fakerProduit = \Faker\Factory::create();
        $fakerProduit->addProvider(new \Bezhanov\Faker\Provider\Commerce($fakerProduit));

        $clients = array();
        $produits = array();
        $index = 0;


        // Creer des Clients
        for ($i = 0; $i < 5; $i++) {
            $client = new Client();
            $client->setNom($faker->name())
                   ->setAdresse($faker->address);

            $clients[$i] = $client;

            $manager->persist($client);
        }

        // Creer des Categories
        for ($i = 0; $i < 5; $i++) {
            $categorie = new Categorie();
            $categorie->setLibelle($fakerCategorie->department);

            for ($j = 0; $j < 6; $j++) {
                $produit = new Produit();
                $produit->setLibelle($fakerProduit->productName)
                        ->setStock($faker->numberBetween(5, 30))
                        ->setPrixUnitaire($fakerProduit->randomNumber(4, true))
                        ->setCategorie($categorie);

                $produits[$index++] = $produit;

                $manager->persist($produit);
            }

            $manager->persist($categorie);
        }

        // Creer des Commandes
        for ($i = 0; $i < 15; $i++) {
            $commande = new Commande();
            $commande->setDateCommande($faker->dateTimeBetween('-8 months'))
                     ->setClient($clients[$faker->numberBetween(0, 4)]);

            $ligneCommande = new LigneCommande();
            $ligneCommande->setQuantite($faker->numberBetween(5, 20))
                          ->setCommande($commande)
                          ->setProduit($produits[$faker->numberBetween(0, 29)]);

            $manager->persist($commande);
            $manager->persist($ligneCommande);
        }

        $manager->flush();
    }
}
