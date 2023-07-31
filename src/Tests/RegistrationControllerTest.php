<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegister(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Inscription');

        $form = $crawler->selectButton('Inscription')->form();
        // Remplacez les valeurs des champs avec des données valides pour le test
        $form['registration_form[email]'] = 'user@example.com';
        $form['registration_form[plainPassword]'] = 'motdepasse';
        $form['registration_form[Nom]'] = 'Nom';
        $form['registration_form[Prenom]'] = 'Prénom';
        // Remplir les autres champs du formulaire...

        $client->submit($form);

        $this->assertResponseRedirects('/'); // Vérifier que l'inscription redirige vers la page d'accueil après succès
    }
}
