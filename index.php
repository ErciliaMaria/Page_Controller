<?php

use App\Control\PessoaControl;

require __DIR__ . '/vendor/autoload.php';

$pagina = new PessoaControl;

$pagina->listar();
