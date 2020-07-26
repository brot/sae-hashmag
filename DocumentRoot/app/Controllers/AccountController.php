<?php

namespace App\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Core\Helpers\Config;
use Core\Session;
use Core\View;

class AccountController
{

    public function orders ()
    {
       
        // Abfrage ob User eingeloggt ist
        if (User::isLoggedIn()) {
           
            // Wenn ja, User aus DB abfragen
            $user = User::getLoggedInUser();

            // Alle Orders vom User laden
            $orders = Order::findByUser($user->id);

            // Passenden View laden
            View::load('account-orders', [
                'orders' => $orders
            ]);
        } else {
       
            // Wenn User nicht eingeloggt ist, auf Login Seite leiten
            header("Location: login");
        }
    }


    public function editForm ()
    {

        // Abfrage ob User eingeloggt ist
        if (User::isLoggedIn()) {
           
            // Wenn ja, User aus DB abfragen
            $user = User::getLoggedInUser();

            // Alle Orders vom User laden
            $orders = Order::findByUser($user->id);

           // Passenden View laden
            View::load('account-edit', [
                'user' => $user,
                'orders' => $orders
            ]);
        } else {
            
            // Wenn User nicht eingeloggt ist, auf Login Seite leiten
            header("Location: login");
        }
    }

 
    public function edit ()
    {

        // Abfrage ob User eingeloggt ist
        if (User::isLoggedIn()) {
          
            // Alle Orders vom User laden
            $user = User::getLoggedInUser();

            // Eigenschaften vom eingeloggten User mit Formulareingabedaten überschreiben
            $user->firstname = trim($_POST['firstname']);
            $user->lastname = trim($_POST['lastname']);
            $user->email = trim($_POST['email']);

            // Passswort gegenchecken, nur wenn gleich dann überschreiben
            if (
                !empty($_POST['password']) &&
                !empty($_POST['password2']) &&
                $_POST['password'] == $_POST['password2']
            ) {
         
                // Mittels setPassword Methode wirt direkt ein Passwort Hash generiert
                $user->setPassword($_POST['password']);
            }

            // User in DB abspeichern
            $user->save();

            // Passende Erfolgsmessage in die Session speichern 
            Session::set('flash', 'Your changes have been saved!');

            // Richtig redirecten
            $baseUrl = Config::get('app.baseUrl');
            header("Location: {$baseUrl}account");
            
        } else {
  
            // Wenn kein User eingeloggt ist, dann leiten wir auf die Login Seite 
            header("Location: login");
        }
    }

}
