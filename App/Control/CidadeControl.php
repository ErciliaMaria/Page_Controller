<?php
namespace App\Control;

use Livro\Database\Criteria;
use Livro\Database\Repository;
use App\Model\Cidade;
use Exception;
use Livro\Control\Page;

class CidadeControl extends Page
{
    public function listar()
    {
        try
        {
            $criteria = new Criteria;
            $criteria->setProperty('order', 'id');
            
            $repository = new Repository(Cidade::class);
            $cidades = $repository->load($criteria);
        
            if($cidades)
            {
                foreach($cidades as $cidade)
                {
                    print "{$cidade->id} - {$cidade->nome} <br>";
                }
            }
        }
        catch(Exception $e)
        {
            print $e->getMessage();
        }
    }
}