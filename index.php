<?php
require __DIR__ . '/vendor/autoload.php';

if($_GET)
{
    $class = $_GET['class'];
    if(class_exists($class))
    {
        $pagina = new $class;
        $pagina->show();
    }
}
