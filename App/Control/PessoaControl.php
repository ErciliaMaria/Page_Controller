<?php
namespace App\Control;

use Livro\Database\Repository;
use Livro\Database\Criteria;
use App\Model\Pessoa;
use Exception;

class PessoaControl 
{
    public function listar()
    {
        try{
            
            $criteria = new Criteria;
            $criteria->setProperty('order', 'id');
            
            $repository = new Repository(Pessoa::class);
            $pessoas = $repository->load($criteria);
          
            if($pessoas)
            {
                foreach($pessoas as $pessoa)
                {
                    print "{$pessoa->id} - {$pessoa->nome} <br>";
                }
            }
        }
        catch(Exception $e)
        {
            print $e->getMessage();
        }
    }
}