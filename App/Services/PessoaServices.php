<?php

namespace App\Services;

use App\Model\Pessoa;
use Exception;

class PessoaServices
{
    public static function getData($request)
    {
        $id_pessoa = $request['id'];

        $pessoa = Pessoa::find($id_pessoa);
        if($pessoa)
        {
            $pessoa_array = $pessoa->toArray();
        }
        else
        {
            throw new Exception("Pessoa {$id_pessoa} não encontrada");
        }
        return $pessoa_array;
    }
}