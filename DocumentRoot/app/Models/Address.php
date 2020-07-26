<?php

namespace App\Models;

use Core\Database;
use Core\Models\ModelTrait;


class Address
{

    // Es werden auch hier ein paar grundlegende Methoden aus dem MVC Core verwendet
    use ModelTrait;

    // Damit die Methoden aus dem ModelTrait funktionieren, müssen wir angeben, auf welche Tabelle sich diese Klasse bezieht
    // @var string
    public static $tableName = 'addresses';

    // Vorher alle Spalten aus der Tabelle definieren
    public $id = 0;
    public $user_id = 0;
    public $address = '';

    // Mittels fill Methode können wir alle Properties der Klasse aus einem DB-Ergebnis befüllen
    // @param array $data
    public function fill (array $data = [])
    {
        $this->id = $data['id'];
        $this->user_id = $data['user_id'];
        $this->address = $data['address'];
    }


    public function save ()
    {

        // Neue Datenbankverbindung herstellen
        $db = new Database();

        
        // Wenn die Adresse schon eine ID hat und somit in der Datenbank bereits existiert, dann aktualisieren wir es
        // mit einem UPDATE Query, andernfalls legen wir mit einem INSERT Query eine neue Adresse an.
        
        if ($this->id > 0) {
            $result = $db->query('UPDATE ' . self::$tableName . ' SET user_id = ?, address = ? WHERE id = ?', [
                'i:user_id' => $this->user_id,
                's:address' => $this->address,
                'i:id' => $this->id
            ]);
        } else {
            $result = $db->query('INSERT INTO ' . self::$tableName . ' SET user_id = ?, address = ?', [
                'i:user_id' => $this->user_id,
                's:address' => $this->address
            ]);
          
            $this->id = $db->getInsertId();
        }

        // Ergebnis zurückgeben
        return $result;
    }

    // @param int $userId
    // @return array
    public static function findByUser (int $userId)
    {
        $db = new Database();

        $tableName = self::$tableName;
        $result = $db->query("SELECT * FROM {$tableName} WHERE user_id = ?", [
            'i:user_id' => $userId
        ]);

        $data = [];
        foreach ($result as $resultItem) {
            $date = new self($resultItem);
            $data[] = $date;
        }

        return $data;
    }

    // Funktionalität, die Newline-Steuerzeichen aus der Datenbank in <br>-Tags umzuwandeln an die Adresse koppeln.
    // @return string
    public function getAddressHtml ()
    {
        $addressWithBR = nl2br($this->address);

        return $addressWithBR;
    }
}
