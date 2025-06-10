<?php
namespace App\Model;

use Livro\Database\Record;

class Pessoa extends Record
{
    const TABLENAME = 'pessoas';

        protected $data;

    public function __get($prop)
    {
        return $this->data[$prop] ?? null;
    }

    public function __set($prop, $value)
    {
        $this->data[$prop] = $value;
    }
}