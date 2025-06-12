<?php
namespace Tests;

use App\Control\PessoaControl;
use PHPUnit\Framework\TestCase;

class PessoaControlTest extends TestCase
{
     public function testList()
    {
        $pessoaControl = new PessoaControl();

        ob_start();
        $pessoaControl->listar();
        $output = ob_get_clean();

        $this->assertStringContainsString('2 - ERCILIA carvalho', $output);
        $this->assertStringContainsString('30 - ERCILIA MARIA COELHO DE CARVALHO', $output);
    }
}