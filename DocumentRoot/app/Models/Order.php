<?php

namespace App\Models;

use Core\Database;
use Core\Models\ModelTrait;


class Order
{

    // Es werden auch hier ein paar grundlegende Methoden aus dem MVC Core verwendet
    use ModelTrait;

    // Angeben auf welche Tabelle sich diese Klasse bezieht
    // @var string
    public static $tableName = 'orders';

    // Tabellen vorher definieren
    public $id = 0;
    public $crdate = 0;
    public $user_id = 0;
    protected $products = '';
    public $delivery_address_id = 0;
    public $invoice_address_id = 0;
    public $payment_id = 0;
    public $status = 'open';

    // @param array $data
    // Mittels fill Methode alle Klassen möglichst einfach und schnell Datenbank-Ergebniss zu befüllen 
    public function fill (array $data = [])
    {
        $this->id = $data['id'];
        $this->crdate = $data['crdate'];
        $this->user_id = $data['user_id'];
        $this->products = $data['products'];
        $this->delivery_address_id = $data['delivery_address_id'];
        $this->invoice_address_id = $data['invoice_address_id'];
        $this->payment_id = $data['payment_id'];
        $this->status = $data['status'];
    }

    // Mittels save Methode können geänderte Daten in die DB speichern
    public function save ()
    {
        $db = new Database();

        if ($this->id > 0) {
            $result = $db->query('UPDATE ' . self::$tableName . ' SET user_id = ?, products = ?, delivery_address_id = ?, invoice_address_id = ?, payment_id = ?, status = ? WHERE id = ?', [
                'i:user_id' => $this->user_id,
                's:products' => $this->products,
                'i:delivery_address_id' => $this->delivery_address_id,
                'i:invoice_address_id' => $this->invoice_address_id,
                'i:payment_id' => $this->payment_id,
                's:status' => $this->status,
                'i:id' => $this->id
            ]);
        } else {
            $result = $db->query('INSERT INTO ' . self::$tableName . ' SET user_id = ?, products = ?, delivery_address_id = ?, invoice_address_id = ?, payment_id = ?, status = ?', [
                'i:user_id' => $this->user_id,
                's:products' => $this->products,
                'i:delivery_address_id' => $this->delivery_address_id,
                'i:invoice_address_id' => $this->invoice_address_id,
                'i:payment_id' => $this->payment_id,
                's:status' => $this->status
            ]);
            $this->id = $db->getInsertId();
        }

        return $result;
    }

    // @param string $status
    // @return array
    public static function findByStatus (string $status = 'open')
    {
        $db = new Database();
        $tableName = self::$tableName;

        $result = $db->query("SELECT * FROM $tableName WHERE status = ?", [
            's:status' => $status
        ]);

        $data = [];
        foreach ($result as $resultItem) {
            $date = new self($resultItem);
            $data[] = $date;
        }

        return $data;
    }

    // @return mixed
    public function getProducts ()
    {
        return json_decode($this->products);
    }


    // In der Datenbank soll ein JSON-String aller Produkte der Order gespeichert werden
    // @param $products
    public function setProducts ($products)
    {
        $this->products = json_encode($products);
    }


    // Für Gesamtpreis alle Produkte durchgehen
    // @return float|int
    public function getPrice ()
    {
        $price = 0;

        foreach ($this->getProducts() as $product) {
            $price += $product->price * $product->quantity;
        }

        return $price;
    }


    // Daten der Lieferadresse aus der Datenbank laden
    //  @return Address
    public function getDeliveryAddress ()
    {
        $address = Address::find($this->delivery_address_id);
        return $address;
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
}
