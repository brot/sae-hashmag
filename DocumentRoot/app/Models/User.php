<?php

namespace App\Models;

use Core\Database;
use Core\Models\BaseUser;
use Core\Models\ModelTrait;


class User

{
    use ModelTrait;
    use BaseUser;

    public static $tableName = 'users';

    public $id = 0;
    public $firstname = '';
    public $lastname = '';
    public $email = '';
    protected $password = '';
    public $is_admin = false;

    public function fill (array $data = [])
    {
        $this->id = $data['id'];
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->is_admin = (bool)$data['is_admin'];
    }


    public function save ()
    {
        $db = new Database();

        if ($this->id > 0) {
            $result = $db->query('UPDATE ' . self::$tableName . ' SET firstname = ?, lastname = ?, email = ?, password = ?, is_admin = ? WHERE id = ?', [
                's:firstname' => $this->firstname,
                's:lastname' => $this->lastname,
                's:email' => $this->email,
                's:password' => $this->password,
                'i:is_admin' => $this->is_admin,
                'i:id' => $this->id
            ]);
        } else {
            $result = $db->query('INSERT INTO ' . self::$tableName . ' SET firstname = ?, lastname = ?, email = ?, password = ?, is_admin = ?', [
                's:firstname' => $this->firstname,
                's:lastname' => $this->lastname,
                's:email' => $this->email,
                's:password' => $this->password,
                'i:is_admin' => $this->is_admin
            ]);
  
            $this->id = $db->getInsertId();
        }

        return $result;
    }
}
