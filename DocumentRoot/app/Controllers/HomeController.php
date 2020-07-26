<?php

namespace App\Controllers;

use App\Models\Product;
use Core\View;

class HomeController
{

    public function index ()
    {

        // Alle Produkte aus der DB abfragen
        $products = Product::all();

        // Passenden View übergeben
        View::load('home', [
            'products' => $products
        ]);

    }

}
