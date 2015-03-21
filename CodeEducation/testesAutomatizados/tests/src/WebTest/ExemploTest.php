<?php

namespace WebTest;

class ExemploTest extends \PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->setBrowser("firefox");
        $this->setBrowserUrl("http://www.wikipedia.org");
    }

    public function testVerificaTitle()
    {
        $this->url("http://www.wikipedia.org");

        $this->assertEquals('Wikipedia', $this->title());
    }

    public function testVerificaSeCampoDeBuscaEstaEmBranco()
    {
        $this->url("/");
        $campoBusca = $this->byId("searchInput");
        
        $this->assertEquals('', $campoBusca->value());
    }

    public function testVerificaSubmitComPHP()
    {
        $this->url("/");
        
        $form = $this->byClassName("search-form");
        
        $campoBusca = $this->byId("searchInput")->value("PHP");
        
        $botao = $this->byName("go");
        $form->submit();

        $titulo = $this->byCssSelector("h1")->text();
        
        $this->assertContains("PHP", $titulo);

    }      
}