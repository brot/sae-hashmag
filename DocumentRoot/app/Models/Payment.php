<?php

namespace App\Models;

use Core\Database;
use Core\Models\ModelTrait;


class Payment
{

    // Es werden auch hier ein paar grundlegende Methoden aus dem MVC Core verwendet
    use ModelTrait;

    // Angeben auf welche Tabelle sich diese Klasse bezieht
    // @var string
    public static $tableName = 'payments';

    // Tabellen vorher definieren
    public $id = 0;
    public $user_id = 0;
    public $name = '';
    public $number = 0;
    public $expires = '';
    public $ccv = 0;

    // @param array $data
    // Mittels fill Methode alle Klassen möglichst einfach und schnell Datenbank-Ergebniss zu befüllen 
    public function fill (array $data = [])
    {
        $this->id = $data['id'];
        $this->user_id = $data['user_id'];
        $this->name = $data['name'];
        $this->number = $data['number'];
        $this->expires = $data['expires'];
        $this->ccv = $data['ccv'];
    }

 
    public function save ()
    {
        $db = new Database();

        if ($this->id > 0) {
            $result = $db->query('UPDATE ' . self::$tableName . ' SET name = ?, number = ?, expires = ?, ccv = ?, user_id = ? WHERE id = ?', [
                's:name' => $this->name,
                's:number' => $this->number,
                's:expires' => $this->expires,
                'i:ccv' => $this->ccv,
                'i:user_id' => $this->user_id,
                'i:id' => $this->id
            ]);
        } else {
            $result = $db->query('INSERT INTO ' . self::$tableName . ' SET name = ?, number = ?, expires = ?, ccv = ?, user_id = ?', [
                's:name' => $this->name,
                's:number' => $this->number,
                's:expires' => $this->expires,
                'i:ccv' => $this->ccv,
                'i:user_id' => $this->user_id,
            ]);
            $this->id = $db->getInsertId();
        }

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
}
