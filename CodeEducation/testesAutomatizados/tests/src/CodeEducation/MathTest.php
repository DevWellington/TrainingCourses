<?php

namespace CodeEducation;

class MathTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $this->assertInstanceOf('CodeEducation\Math', new \CodeEducation\Math());
    }

    public function somaProvider()
    {
        return [
            [2,2,4],
            [10,10,20],
            [10,15,25],
            [15,15,30]
        ];
    }

    /**
     * @dataProvider somaProvider
     */
    public function testVerificaSeConsegueSomarComProvider($x, $y, $resultado)
    {
        $math = new \CodeEducation\Math();

        $res = $math->soma($x, $y);
        $this->assertEquals($resultado, $res);
    }

    public function testVerificaSeConsegueSomar()
    {
        $math = new \CodeEducation\Math();

        $resultado = $math->soma(10, 12);
        $this->assertEquals(22, $resultado);

        // Triangulação, valida novamente o teste para casos de coincidencias
        $resultado = $math->soma(2, 3);
        $this->assertEquals(5, $resultado);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testVerificaSeConsegueSomarQuandoValorNaoENumerico()
    {
        $math = new \CodeEducation\Math();

        $resultado = $math->soma(1, "Isso eh um teste");
    }
}
