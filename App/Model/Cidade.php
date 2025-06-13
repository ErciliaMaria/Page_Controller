<?php
namespace App\Model;

use Livro\Database\Record;

class Cidade extends Record
{
    const TABLENAME = 'cidades';

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