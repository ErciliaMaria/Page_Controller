<?php

require_once 'Lib/Livro/Database/ConnectionPessoa.php';
require_once 'Lib/Livro/Database/Criteria.php';


use Livro\Database\ConnectionPessoa;
use Livro\Database\Criteria;

$obj1 = ConnectionPessoa::open('livro');
var_dump($obj1);