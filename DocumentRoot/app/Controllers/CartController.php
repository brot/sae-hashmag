<?php

namespace App\Controllers;

use App\Models\Cart;
use Core\Helpers\Config;
use Core\Session;
use Core\View;

class CartController
{

    // Inhalte aus dem Cart laden
    public function index ()
    {
        $cart = new Cart();

        View::load('cart', [
            'cartContent' => $cart->getProducts()
        ]);
        
    }

   
   
    // @param int $productId
    public function addProductToCart (int $productId)
    {
        
        // Cart laden
        $cart = new Cart();

        // Mittels is abfragen, ob eingegebener wert numerisch ist
        if (isset($_POST['quantity']) && is_numeric($_POST['quantity'])) {
   
            // Produkte in der angegebenen Anzahl ins Cart legen
            $cart->addProduct($productId, $_POST['quantity']);
        } else {
          
            // Ein Stück von der productID hinzufügen
            $cart->addProduct($productId);
        }

        // Mittels referrer auf die vorherige URL zurück leiten
        $referrer = Session::get('referrer');
        header("Location: $referrer");
        exit;
    }

   
    //@param int $productId
    public function removeProductFromCart (int $productId)
    {
        
        // Cart laden
        $cart = new Cart();

        
        // 1 Stück von $productId entfernen
        $cart->removeProduct($productId);

      
        // Mittels referrer auf die vorherige URL zurück leite
        $referrer = Session::get('referrer');
        header("Location: $referrer");
    }

    
    //@param int $productId
     
    public function deleteProductFromCart (int $productId)
    {
       
        // Cart laden
        $cart = new Cart();

        // Cart Produkt updaten
        $cart->updateProduct($productId, 0);

        // Mittels referrer auf die vorherige URL zurück leite
        $referrer = Session::get('referrer');
        header("Location: $referrer");
    }

    
    // @param int $productId 
    public function updateProductInCart (int $productId)
    {
       
        // Neue Anzahl aus dem Formular abfragen
        $newQuantity = (int)$_POST['quantity'];

        // Cart laden
        $cart = new Cart();

        // Cart Produkt updaten
        $cart->updateProduct($productId, $newQuantity);

        // Mittels referrer auf die vorherige URL zurück leite
        $referrer = Session::get('referrer');
        header("Location: $referrer");
    }


    public function updateTotalProducts (int $productId)
    {
        
        // Cart laden
        $cart = new Cart();

        // Cart Produkt updaten
        $cart->updateTotalProducts($quantity);
        
        // Passenden view übergeben
        View::load('header', [
            'cartContent' => $cart->updateTotalProducts()
        ]);
    }

}
