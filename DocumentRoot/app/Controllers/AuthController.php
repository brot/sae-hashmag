<?php

namespace App\Controllers;

use App\Models\User;
use Core\Helpers\Config;
use Core\Helpers\Validator;
use Core\Libs\PHPMailer;
use Core\Session;
use Core\View;

class AuthController
{

    public function loginForm ()
    {
        
        // Mittels if abfrageb ob User eingeloggt ist
        if (User::isLoggedIn()) {
           
            // User aus DB laden
            $user = User::getLoggedInUser();

           
            // Je nachdem ob der Account ein Admin ist oder nicht, leiten wir wo anders hin
            $redirectUrl = 'home';
            if ($user->is_admin === true) {
                $redirectUrl = 'dashboard';
            }

            header("Location: $redirectUrl");
            exit;

        } else {
    
            // Wenn kein User eingeloggt ist, dann leiten wir nach Login weiter und übergeben die Fehler
            View::load('login', [
                'errors' => Session::get('errors', [], true),
            ]);
        }
    }

    public function login ()
    {

        // Mittels if abfrageb ob User eingeloggt ist
        if (User::isLoggedIn()) {
            $user = User::getLoggedInUser();

            $redirectUrl = 'home';
            if ($user->is_admin === true) {
                $redirectUrl = 'dashboard';
            }

            header("Location: $redirectUrl");
            exit;
        } else {
            
            // Errors array vorbereiten
            $errors = [];

            // Mittels if abfragen, ob ein Passwort übergeben worden ist
            if (isset($_POST['email']) && isset($_POST['password'])) {
        
                // In Var deklarieren
                $email = $_POST['email'];
                $passwordFromForm = $_POST['password'];

                // Account bei eingegebener Email Adresse aus DB laden
                $user = User::findByEmail($email);
              
                //Wenn ein $user zur eingegeben Email-Adresse gefunden wurde UND das Passwort übereinstimmt, leiten wir weiter, sonst schreiben wir einen Fehler.
                if ($user && $user->checkPassword($passwordFromForm)) {
                    $redirectUrl = 'home';

                    if ($user->is_admin === true) {
                        $redirectUrl = 'dashboard';
                    }

                    $user->login($redirectUrl);
                } else {
                    $errors[] = "Either user does not exist or your password is wrong.";
                }
            } else {
                if (!isset($_POST['email'])) {
                    $errors[] = "E-mail-address can't be left blank.";
                }

                if (!isset($_POST['password'])) {
                    $errors[] = "Password can't be left blank.";
                }
            }

            // Fehler in Session speichern
            Session::set('errors', $errors);
            header("Location: login");
            exit;
        }
    }

    public function logout ()
    {
       
        // User ausloggen und redirecten
        User::logout("home");
    }

 
    public function signupForm ()
    {
        if (User::isLoggedIn()) {
            $user = User::getLoggedInUser();

            $redirectUrl = 'home';
            if ($user->is_admin === true) {
                $redirectUrl = 'dashboard';
            }

            header("Location: $redirectUrl");
            exit;
        } else {
            View::load('signup', [
                'errors' => Session::get('errors', [], true),
            ]);
        }
    }

    public function signup ()
    {
      
        $baseUrl = Config::get('app.baseUrl');

        // Alle Daten validieren
        $validator = new Validator();
        $validator->validate($_POST['firstname'], 'Firstname', true, 'text', 2, 255);
        $validator->validate($_POST['lastname'], 'Lastname', true, 'text', 2, 255);
        $validator->validate($_POST['email'], 'Email', true, 'email');
        $validator->validate($_POST['password'], 'Passwort', true, 'password');
        $validator->compare($_POST['password'], $_POST['password2']);
  
        // Fehler aus Validator holen
        $errors = $validator->getErrors();

        // Mittels if abfagen, ob die email adresse schon verwendet wurde
        if (User::findByEmail($_POST['email']) !== false) {
            $errors[] = "Sorry! This E-Mail-Address ist already taken.";
        }

        // Wenn Fehler aufgetreten sind, dann diese in Session speichern
        if (!empty($errors)) {
            Session::set('errors', $errors);
            header("Location: $baseUrl/sign-up");
            exit;
        }

        // Account mit allen Daten speichern
        $user = new User();
        $user->firstname = $_POST['firstname'];
        $user->lastname = $_POST['lastname'];
        $user->email = $_POST['email'];
        $user->setPassword($_POST['password']);
        $user->save();

        // PHP Mailer einbauen, damit email verschickt werden kann wenn registrierung erfolgreich war
        if (PHPMailer::ValidateAddress($user->email)) {
            $mail = new PHPMailer();
            $mail->isMail();
            $mail->AddAddress($user->email);
            $mail->SetFrom('no-reply@mvc-sae.at');
            $mail->Subject = 'A very warm welcome!';
            $mail->Body = 'You have successfully registerted to our newsletter! We are happy you are here!';

            $mail->Send();

            header("Location: $baseUrl/login");
            exit;
        } else {
   
            // wenn keine gültige email adresse verwendet wurde erkennt php mailer das und gibt einen fehler aus
            die('PHPMailer Error');
        }
    }

}
