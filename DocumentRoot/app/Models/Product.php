<?php

namespace App\Models;

use Core\Database;
use Core\Models\ModelTrait;

class Product
{

    // Es werden auch hier ein paar grundlegende Methoden aus dem MVC Core verwendet
    use ModelTrait;

    // @var string
    public static $tableName = 'products';

    // Vorher alle Spalten aus der Tabelle definieren
    public $id = 0;
    public $name = '';
    public $description = null;
    public $full_description = '';
    public $price = 0.0;
    public $stock = 0;
    public $images = [];


    // @var string
    // Mittels delimiter die Produktbilder in einen String verpacken und in der DB speichern  
    public static $imagesDelimiter = ';';

    // Mittels fill Methode können wir alle Properties der Klasse aus einem DB-Ergebnis befüllen
    // @param array $data
    public function fill (array $data = [])
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->full_description = $data['full_description'];
        $this->price = $data['price'];
        $this->stock = $data['stock'];

        if (!empty($data['images'])) {
            if (strpos($data['images'], self::$imagesDelimiter) >= 0) {
                $this->images = explode(self::$imagesDelimiter, $data['images']);
            } else {
                $this->images[] = $data['images'];
            }
        }
    }

    public function save ()
    {
        $db = new Database();

        // Mittels implode Array in String umwandeln
        $_images = implode(self::$imagesDelimiter, $this->images);

        if ($this->id > 0) {
            $result = $db->query('UPDATE ' . self::$tableName . ' SET name = ?, description = ?, full_description = ?, price = ?, stock = ?, images = ? WHERE id = ?', [
                's:name' => $this->name,
                's:description' => $this->description,
                's:full_description' => $this->full_description,
                'd:price' => $this->price,
                'i:stock' => $this->stock,
                's:images' => $_images,
                'i:id' => $this->id
            ]);
        } else {
            $result = $db->query('INSERT INTO ' . self::$tableName . ' SET name = ?, description = ?, full_description = ?, price = ?, stock = ?, images = ?', [
                's:name' => $this->name,
                's:description' => $this->description,
                's:full_description' => $this->full_description,
                'd:price' => $this->price,
                'i:stock' => $this->stock,
                's:images' => $_images
            ]);
    
            $this->id = $db->getInsertId();
        }

        return $result;
    }

 
    // @return string
    // Preis formatieren
    public function getPrice ()
    {
        return self::formatPrice($this->price);
    }


    // @return string 
    // Preis weiter formatieren
    public function getPriceFloat ()
    {
        return sprintf('%.2f', $this->price);
    }


    // @param $price
    // @return string
    public static function formatPrice ($price)
    {
        return sprintf('&euro; %.2f ,-', $price);
    }


    // @param string $filepath
    // Pfad in $this->images einfügen, dient als Hilfsfuntkion
    public function addImage (string $filepath)
    {
        if (!in_array($filepath, $this->images)) {
            $this->images[] = $filepath;
        }
    }


    // Übergebenen Pfad aus $this->images löschen, dient als Hilfsfuntkion
    // @param string $filepath
    public function removeImage (string $filepath)
    {
        $indexForFilepath = array_search($filepath, $this->images);
        
        if ($indexForFilepath !== false) {
            unset($this->images[$indexForFilepath]);
        }
    }
}
