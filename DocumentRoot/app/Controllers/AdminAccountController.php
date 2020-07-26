<?php

namespace App\Controllers;

use App\Models\User;
use Core\Helpers\Config;
use Core\Session;
use Core\View;

class AdminAccountController
{

    public function list ()
    {
    
        // Abfragen ob User eingeloggt und Admin ist
        if (User::isLoggedIn() && User::getLoggedInUser()->is_admin === true) {

            // Alle User aus der DB laden
            $users = User::all();

            // Passenden View laden und User übergeben
            View::load('admin/users', [
                'users' => $users
            ]);
        } else {
         
            // Wenn kein User eingeloggt ist, dann leider wir auf die Login Seite 
            header("Location: login");
        }
    }


    // @param int $id
    public function editForm (int $id)
    {

        // Abfragen ob User eingeloggt und Admin ist
        if (User::isLoggedIn() && User::getLoggedInUser()->is_admin === true) {

            // User aus DB laden
            $user = User::find($id);

            // Passenden View laden und User übergeben
            View::load('admin/account-edit', [
                'user' => $user
            ]);
        } else {

            // Wenn kein User eingeloggt ist, dann leider wir auf die Login Seite 
            header("Location: login");
        }
    }


    // @param int $id
    public function edit (int $id)
    {

        // Abfragen ob User eingeloggt und Admin ist
        if (User::isLoggedIn() && User::getLoggedInUser()->is_admin === true) {
            
            // User aus DB laden
            $user = User::find($id);

            // Eigenschaften von User mittels Formulareingabedaten überschreiben
            $user->firstname = trim($_POST['firstname']);
            $user->lastname = trim($_POST['lastname']);
            $user->email = trim($_POST['email']);

            // Passwort nur dann überschreiben, wenn sie ident sind
            if (
                !empty($_POST['password']) &&
                !empty($_POST['password2']) &&
                $_POST['password'] == $_POST['password2']
            ) {
         
                // Mittels setPassword Methode wird ein Passwort Hash generiert
                $user->setPassword($_POST['password']);
            }

            // Wenn Checkbox "isAdmin" angegeben wurde, dann soll $user->is_admin true sein, sonst soll es false sein.
            $user->is_admin = (isset($_POST['isAdmin']) && $_POST['isAdmin'] === 'on') ? true : false;

            // User in DB speichern
            $user->save();

            // Erfolgsmeldung in Session speichern
            Session::set('flash', 'Youre changes have been successfully saved!');

            // Richtid redirecten
            $baseUrl = Config::get('app.baseUrl');
            header("Location: {$baseUrl}dashboard/accounts");

        } else {

            // Wenn kein User eingeloggt ist, dann leiten wir auf die Login Seite weiter
            header("Location: login");
        }
    }


    // @param int $id
    public function deleteForm (int $id)
    {

        // Abfragen ob User eingeloggt und Admin ist
        if (User::isLoggedIn() && User::getLoggedInUser()->is_admin === true) {

            // User aus DB laden
            $user = User::find($id);

            // Passenden View laden und User übergeben
            View::load('admin/confirm-user-delete', [
                'user' => $user
            ]);
        } else {
            
            // Wenn kein User eingeloggt ist, dann leider wir auf die Login Seite weiter
            header("Location: login");
        }
    }


    // @param int $id
    public function delete (int $id)
    {

        // Abfragen ob User eingeloggt und Admin ist
        if (User::isLoggedIn() && User::getLoggedInUser()->is_admin === true) {

            // User löschen
            User::delete($id);

            // Richtig redirecten
            $baseUrl = Config::get('app.baseUrl');
            header("Location: {$baseUrl}dashboard/accounts");

        } else {

            // Wenn kein User eingeloggt ist, dann leider wir auf die Login Seite weiter
            header("Location: login");
        }
    }

}
