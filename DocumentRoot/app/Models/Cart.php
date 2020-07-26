<?php

namespace App\Models;

use Core\Session;


class Cart
{

    protected $products = [];

    // Cart als Constante definieren
    const CART_KEY = 'cart';

    // Der Konstruktor lädt das Cart aus der Session und speichert es in $this->product.
    public function __construct ()
    {
        $this->products = Session::get(self::CART_KEY, []);
    }

    // Der Destruktur nimmt $this->product und speichert es zurück in die Session
    public function __destruct ()
    {
        Session::set(self::CART_KEY, $this->products);
    }


    // Anzahl eines Produktes direkt im Warenkorb aktualiesieren
    // @param int $productId
    // @param int $quantity
    public function updateProduct (int $productId, int $quantity = 1)
    {
        if ($quantity <= 0) {
            unset($this->products[$productId]);
        } else {
            $this->products[$productId] = $quantity;
        }
    }

    // Produkt zum Warenkorb hinzufügen
    // @param int $productId
    // @param int $quantity
    public function addProduct (int $productId, int $quantity = 1)
    {
        if (array_key_exists($productId, $this->products)) {
            $this->updateProduct($productId, $this->products[$productId] + $quantity);
        } else {
            $this->updateProduct($productId, $quantity);
        }
    }


    // Produkt aus dem Warenkorb entfernen
    // @param int $productId
    // @param int $quantity
    public function removeProduct (int $productId, int $quantity = 1)
    {
        if (array_key_exists($productId, $this->products)) {
            $this->updateProduct($productId, $this->products[$productId] - $quantity);
        }
    }


    // @return array
    public function getProducts ()
    {
        $_products = [];

        // Mittels Schleife Warenkorb durchgehen
        foreach ($this->products as $productId => $quantity) {
  
            // Produkt anhand der $productId aus der Datenbank laden
            $product = Product::find($productId);

            $product->quantity = $quantity;

            // $product zu Rückgabe-Array hinzufügen
            $_products[] = $product;

        }

        return $_products;
    }


    // Einfache Möglichkeit alle Produkte auf einmal aus dem Cart zu werfen
    public function flush ()
    {
        // Produlte auf Ausgangswert setzen
        $this->products = [];
    }

    // Total Quantitiy im Header ausgeben
    public static function totalProducts () {

        $product_count = 0;

        $cart = new self();
    
        foreach ($cart->getProducts() as $product) {
            $product_count = $product_count + $product->quantity;
        }
    
        return $product_count;
    }

}
