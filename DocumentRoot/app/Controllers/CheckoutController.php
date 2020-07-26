<?php

namespace App\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Core\Helpers\Config;
use Core\Session;
use Core\View;

class CheckoutController
{

    const PAYMENT_KEY = 'checkout-paymentId';
    const ADDRESS_KEY = 'checkout-addressId';

    public function paymentForm ()
    {

        // Mittels if abfrageb ob User eingeloggt ist
        if (User::isLoggedIn()) {

            // User aus DB laden
            $user = User::getLoggedInUser();

            // Alle Zahlungsmethoden des eingeloggten Users abfragen
            $payments = Payment::findByUser($user->id);

            // errrors in Session Speichern
            $errors = Session::get('errors', [], true);
            

            // passenden View laden
            View::load('payment', [
                'payments' => $payments,
                'errors' => $errors
            ]);
        } else {

            // Wenn der User nicht eingeloggt ist, leiten wir zum Login weiter
            header("Location: login");
        }
    }

    public function handlePayment ()
    {
        // BaseUrl abfragen
        $baseUrl = Config::get('app.baseUrl');

        // Eingeloggten User abfragen
        $user = User::getLoggedInUser();

        // Mittels if abfragen, ob Formular abgeschickt wurde und default nicht der übermittelte Wert ist
        if (isset($_POST['payment']) && $_POST['payment'] !== '_default') {

        // PaymentID in Session speichern
        Session::set(self::PAYMENT_KEY, (int)$_POST['payment']);
        }

        // Mittels if abfragen ob Formular abgeschickt wurde
        if (isset($_POST['name']) && !empty($_POST['name'])) {

            // Neue Payment Methode erstellen und in die DB speichern
            $payment = new Payment();
            $payment->name = $_POST['name'];
            $payment->number = $_POST['number'];
            $payment->expires = $_POST['expires'];
            $payment->ccv = $_POST['ccv'];
            $payment->user_id = $user->id;
            $payment->save();

            // ID der neu erstellen zahlungsmethode in Session speichern
            Session::set(self::PAYMENT_KEY, (int)$payment->id);
        }


        // Mittels if abfragen, ob eine der Zahlungsmethode ausgewählt wurde
        if (
            (
                !isset($_POST['payment']) ||
                $_POST['payment'] === '_default'
            )
            &&
            (
                !isset($_POST['name']) ||
                empty($_POST['name'])
            )
        ) {

            // Error in Session speichern
            Session::set('errors', [
                'Please choose an existing payment, or create a new one.'
            ]);
            
            // Richtig weiterleiten
            header("Location: {$baseUrl}checkout");
            exit;
        }

        // Zum nächsten Schritt im Checkout weiterleiten
        header("Location: {$baseUrl}checkout/address");
        exit;
    }

    public function addressForm ()
    {

        // Mittels if abfrageb ob User eingeloggt ist
        if (User::isLoggedIn()) {
       
            // User aus DB abfragen
            $user = User::getLoggedInUser();

            // dazugehörigen Adressen abfragen
            $addresses = Address::findByUser($user->id);

            // Errors in Session speichern
            $errors = Session::get('errors', [], true);

            // Passenden View laden
            View::load('address', [
                'addresses' => $addresses,
                'errors' => $errors
            ]);
        } else {
     
            // Wenn kein User eingeloggt ist, auf die Login Seite weiterleiten
            header("Location: login");
        }
    }


    public function handleAddress ()
    {
        $baseUrl = Config::get('app.baseUrl');

        // Eingeloggten User abfragen
        $user = User::getLoggedInUser();

        // Mittels if abfragen ob Formular abgeschickt wurde und nicht default als Wert übermittelt wird
        if (isset($_POST['address_id']) && $_POST['address_id'] !== '_default') {
            
            // AdressID in Session speichern
            Session::set(self::ADDRESS_KEY, (int)$_POST['address_id']);
        }

        // Mittels address gesetzt worden ist
        if (isset($_POST['address']) && !empty($_POST['address'])) {

            // Neue Addresse erstellen und in die DB speichern
            $address = new Address();
            $address->address = $_POST['address'];
            $address->user_id = $user->id;
            $address->save();

            // ID in die Session speichern
            Session::set(self::ADDRESS_KEY, (int)$address->id);
        }


        // Mittels if abfragen, ob eine der Zahlungsmethode ausgewählt wurde
        if (
            (
                !isset($_POST['address_id']) ||
                $_POST['address_id'] === '_default'
            )
            &&
            (
                !isset($_POST['address']) ||
                empty($_POST['address'])
            )
        ) {

            // Error in Session speichern
            Session::set('errors', [
                'Please choose an existing address, or create a new one.'
            ]);
            
            // Weiterleiten
            header("Location: {$baseUrl}checkout/address");
            exit;
        }
        
        // Zum nächsten Schritt im Checkout weiterleiten
        header("Location: {$baseUrl}checkout/final");
        exit;
    }

    
    public function finalOverview ()
    {

        // PaymentId und AddressID aus der Session auslesen
        $paymentId = Session::get(self::PAYMENT_KEY);
        $addressId = Session::get(self::ADDRESS_KEY);

        // Payment und Address anhand der IDs aus der Datenbank holen
        $payment = Payment::find($paymentId);
        $address = Address::find($addressId);

        // neues cart erstellen
        $cart = new Cart();

        // Eingeloggten User laden
        $user = User::getLoggedInUser();

        // Passenden View übergeben
        View::load('checkout-final', [
            'products' => $cart->getProducts(),
            'payment' => $payment,
            'address' => $address,
            'user' => $user
        ]);
    }


    public function finaliseCheckout ()
    {
        
        // PaymentId und AddressID aus der Session auslesen
        $paymentId = Session::get(self::PAYMENT_KEY);
        $addressId = Session::get(self::ADDRESS_KEY);

        // neues cart erstellen
        $cart = new Cart();

        // Product Daten aus der DB speichern
        $products = $cart->getProducts();

        // Eingeloggten User laden
        $user = User::getLoggedInUser();

        // Neue Order anlegen und befüllen
        $order = new Order();
        $order->user_id = $user->id;
        $order->delivery_address_id = $addressId;
        $order->invoice_address_id = $addressId;
        $order->payment_id = $paymentId;
 
        // Die setProducts()-Methode des Order Models speichert direkt eine serialisierte Version der Produkte in das Model
        $order->setProducts($products);
        $order->save();

        // Cart mittels flush leeren
        $cart->flush();

        // Während des Checkout ausgewählte Adresse und Payment Methode aus der Session löschen
        Session::forget(self::PAYMENT_KEY);
        Session::forget(self::ADDRESS_KEY);

        // Erfolgsmeldung in Session speichern
        Session::set('flash', 'Thank you! Your order has been successfully placed!');

        // Richtig redirecten
        $baseUrl = Config::get('app.baseUrl');
        header("Location: {$baseUrl}account/orders");
        exit;
    }

}
