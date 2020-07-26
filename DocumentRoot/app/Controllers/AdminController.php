<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Core\Database;
use Core\View;

class AdminController
{

    public function dashboard ()
    {
    
        // Datenbankverbindung herstellens
        $db = new Database();

        // Falls kein Account eingeloggt ist oder er kein Admin ist, dann soll zur Startseite geleitet werden
        if (!User::isLoggedIn() || !User::getLoggedInUser()->is_admin) {
            header('Location: home');
            exit;
        }

        // Anzahl der User in query speichern
        $numberOfUsers = $db->query("SELECT COUNT(*) AS numberofusers, is_admin FROM users GROUP BY is_admin");


        // Alle Produkte anzeigen
        $products = Product::all();
  

        // Bestellstatistik in query speichern
        $productStats = $db->query('SELECT COUNT(*) AS count, status AS label FROM orders GROUP BY status');

        // Liste von offenen Bestellungen anzeigen
        $openOrders = Order::findByStatus('open');

        // Liste von Bestellungen inDelivery anzeigen
        $inDelivery = Order::findByStatus('in delivery');

        // Liste von Bestellungen inProgress anzeigen
        $inProgress = Order::findByStatus('in progress');

        // Passende Daten an View übergeben
        View::load('admin/dashboard', [
            'numberOfUsers' => $numberOfUsers,
            'products' => $products,
            'productStats' => $productStats,
            'openOrders' => $openOrders,
            'inDelivery' => $inDelivery,
            'inProgress' => $inProgress
        ]);

        // Alle Orders anzeigen
        $allOrders = $db->query('SELECT * FROM orders');

        // Passende Daten an View übergeben
        View::load('admin/dashboard', [
            'allOrders' => $allOrders
        ]);

    }

}
