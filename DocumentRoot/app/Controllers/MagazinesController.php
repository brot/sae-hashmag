<?php

namespace App\Controllers;

use App\Models\Product;
use Core\View;

class MagazinesController
{

    public function list ()
    {

        // Alle Produkte laden
        $products = Product::all();

        // passende View übergeben
        View::load('magazines', [
            'products' => $products
        ]);

    }

    public function showProduct (int $productIdFromUrl)
    {

        // ID speichern
        $id = $productIdFromUrl;

        // Produkt mittels id finden       
        $product = Product::find($id);

        // passende View übergeben
        View::load('product', [
            'product' => $product
        ]);
        
    }

}
