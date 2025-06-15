<?php

header('Content-Type: application/json; charset=utf-8');
require 'vendor/autoload.php';

class LivroRestServer 
{
    public static function run($request)
    {
        $class = isset($request['class']) ? $request['class'] : '';
        $method = isset($request['method']) ? $request['method'] : '';
       
        try
        {
            if(class_exists($class)){
                if(method_exists($class, $method)){
                    $response = call_user_func([$class, $method], $request);
                    return json_encode( ['status' => 'success',
                                        'data' => $response]);
                }
                else{
                    return json_encode( ['status' => 'error',
                                        'data' => "Método {$method} não encontrado"]);
                }
            }
            else{
                return json_encode( ['status' => 'error',
                                        'data' => "Classe {$class} não encontrado"]);
            }
        }
        catch (Exception $e)
        {
            return json_encode( ['status' => 'error',
                                        'data' => $e->getMessage()]);
        }
    }
}
print LivroRestServer::run($_REQUEST);