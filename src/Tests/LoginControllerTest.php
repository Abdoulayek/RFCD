<?php
// Fichier : tests/Controller/SecurityControllerTest.php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testLogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Connexion');

        // Remplacez les valeurs des champs avec des données valides pour le test
        $form = $crawler->selectButton('Se connecter')->form();
        $form['email'] = 'user@example.com';
        $form['password'] = 'motdepasse';

        $client->submit($form);

        $this->assertResponseRedirects('/'); // Vérifier que la connexion redirige vers la page d'accueil après succès
    }

    // Vous pouvez également écrire d'autres méthodes de test pour les différentes fonctionnalités du contrôleur de connexion, si nécessaire.
}
