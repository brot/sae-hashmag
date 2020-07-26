<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\User;
use Core\Helpers\Config;
use Core\Helpers\Validator;
use Core\Session;
use Core\View;

class AdminProductController
{

    //@param int $id
    public function editForm (int $id)
    {
      
        // Produkte aus DB abfragen
        $product = Product::find($id);

        // Passenden View laden
        View::load('admin/productForm', [
            'product' => $product,
            'errors' => Session::get('errors', [], true)
        ]);
    }


    // @param int $id
    public function edit (int $id)
    {
      
        // Validator einbinden
        $validator = new Validator();
        $validator->validate($_POST['name'], 'Name', true, 'textnum', 2, 255);
        $validator->validate($_POST['stock'], 'Stock', true, 'num');
     
        
        // Wenn Fehler aufgetreten sind, dann aus Validator abfragen
        $errors = $validator->getErrors();

        // BaseUrl für redirects abfragen
        $baseUrl = Config::get('app.baseUrl');

        // Wenn Fehler aufgetreten sind, dann diese in Session speichern
        if ($errors !== false) {
            Session::set('errors', $errors);
            header("Location: $baseUrl/products/$id/edit");
            exit;
        }

        // Product aus der DB fragen
        $product = Product::find($id);
       
        
        // Eigenschaften von Produkt überschreiben
        $product->name = $_POST['name'];
        $product->description = $_POST['description'];
        $product->full_description = $_POST['full_description'];
        $product->price = (float)$_POST['price'];
        $product->stock = (int)$_POST['stock'];


        // Mittels foreach Schleife das Array an hochgeladenen Dateien durchgehen
        foreach ($_FILES['images']['error'] as $index => $error) {
          
            // Wenn keine Fehler aufgetreten sind, dann kann man Datei weiter verarbeiten
            if ($error === 0) {
 
                // Da es sich um ein Bild handelt wird auch nur der richtige MIME-Type akzeptiert
                $type = $_FILES['images']['type'][$index];
                $type = explode('/', $type)[0];

                // Mittels if abfrageb, ob es sich um ein Bild handelt
                if ($type === 'image') {
                    
                    // $tmp_name ist der Dateipfad, an den PHP das File temporär gespeichert hat.
                    $tmp_name = $_FILES['images']['tmp_name'][$index];

                    // Sicher stellen, dass nur der originale Dateiname entgegen genommen wirde
                    $filename = basename($_FILES['images']['name'][$index]);

                    // Timestamp an Ende anfügen
                    $filename = time() . "_" . $filename;

                    // Absoluten Pfad definieren
                    $destination = __DIR__ . "/../../storage/uploads/$filename";

                    // Hochgeladene Date nach Destination verschieben
                    move_uploaded_file($tmp_name, $destination);

                    // Bild in PHP Objekt im RAM vom Server speichern
                    $product->addImage("uploads/$filename");
                }
            }
        }

        // Mittels isset abfragen, ob Checkbox delete ausgewählt wurde
        if (isset($_POST['delete-images'])) {
          
            // Bild dann auch physisch vom Server löschen
            foreach ($_POST['delete-images'] as $imagePath => $unusedValue) {
                
                // Datei von Produkt entfernen
                $product->removeImage($imagePath);

                // Mittels Unlink-Funktion Datei löschen
                unlink(__DIR__ . "/../../storage/$imagePath");
            }
        }

        // Aktualisierte Eigenschaften in die DB speichern
        $product->save();

        // Richtid redirecten
        header("Location: $baseUrl/dashboard");
        exit;
    }


    public function addForm ()
    {
        // passenden View laden
        View::load('admin/productAddForm', [
            'errors' => Session::get('errors', [], true)
        ]);
    }


    public function add ()
    {
      
        // Validator anlegen
        $validator = new Validator();
        $validator->validate($_POST['name'], 'Name', true, 'textnum', 2, 255);
        $validator->validate($_POST['stock'], 'Stock', true, 'num');
         
        // Falls Fehler aufgetreten sind, mittels Validator abfragen
        $errors = $validator->getErrors();

        // BaseUrl abfragen
        $baseUrl = Config::get('app.baseUrl');

        // Mittels if abfragen, ob Fehler aufgetreten sind
        if (!empty($errors)) {
            Session::set('errors', $errors);
            header("Location: {$baseUrl}dashboard/products/add");
            exit;
        }

        // Produkt aus der DB abfragen
        $product = new Product();
     
        // Eigenschaften von Produkt überschreiben
        $product->name = $_POST['name'];
        $product->description = $_POST['description'];
        $product->price = (float)$_POST['price'];
        $product->stock = (int)$_POST['stock'];

   
        // Hochgeladene Datei entgegen nehmen
        foreach ($_FILES['images']['error'] as $index => $error) {
        
            // Mittels if abfragen ob Fehler aufgetreten sind
            if ($error === 0) {

                // Da es sich um ein Bild handelt wird auch nur der richtige MIME-Type akzeptiert
                $type = $_FILES['images']['type'][$index];
                $type = explode('/', $type)[0];

                // Mittels if abfragen ob es sich um ein Bild handelt
                if ($type === 'image') {
                    
                    // $tmp_name ist der Dateipfad, an den PHP das File temporär gespeichert hat.
                    $tmp_name = $_FILES['images']['tmp_name'][$index];

                    // Sicher stellen, dass nur der originale Dateiname entgegen genommen wirde
                    $filename = basename($_FILES['images']['name'][$index]);

                    // Timestamp an Dateiname hinzufügen
                    $filename = time() . "_" . $filename;

                    // Absoluten Pfad erstellen
                    $destination = __DIR__ . "/../../storage/uploads/$filename";

                    // Hochgeladenen Dateien verschieben
                    move_uploaded_file($tmp_name, $destination);

                    // Bild in PHP Objekt im RAM vom Server speichern
                    $product->addImage("uploads/$filename");
                }
            }
        }

        // Neues Produkt in DB speichern
        $product->save();

        // Richtig redirecten
        header("Location: $baseUrl/dashboard");
        exit;
    }


    
    // @param int $id     
    public function deleteForm (int $id)
    {
        // Mittels if abfragen, ob User eingeloggt und Admin ist
        if (User::isLoggedIn() && User::getLoggedInUser()->is_admin === true) {

            // Product finden
            $product = Product::find($id);
            
            // Passenden View vergeben
            View::load('admin/confirm-product-delete', [
                'product' => $product
            ]);
        } else {

            // Ist kein User eingeloggt, dann leiten wir auf die Login Seite weiter
            header("Location: login");
        }
    }

    
    // @param int $id
    public function delete (int $id)
    {

        // Mittels if abfragen, ob User eingeloggt und Admin ist
        if (User::isLoggedIn() && User::getLoggedInUser()->is_admin === true) {

            // Produt löschen
            Product::delete($id);

            // Passend redirecten
            $baseUrl = Config::get('app.baseUrl');
            header("Location: {$baseUrl}dashboard");
            

        } else {

            // Ist kein User eingeloggt, dann leiten wir auf die Login Seite weiter
            header("Location: login");
        }
    }
}
