<?php
use Article\ArticleSeparator;

class ArticleSeparatorTest extends PHPUnit_Framework_TestCase{
    private $article;
    private $text;
    
    protected function setUp() {
        $this->changeArticle("EUROLIGA DE BASCHET MASCULIN\nRedactor: Vadim Iutiș\nINTRO:\nMeciuri tari în etapa inaugurală a turneului Top 16\nBETA:\nÎn grupele preliminare E și F ale turneului Top 16 din Euroliga de Baschet masculin în noul an au fost jucate 6 partide din etapa inaugurală.");        
    }
    
    protected function changeArticle($text = ""){        
        $this->article = new ArticleSeparator($text);
    }
    
    protected function callPrivateMethod($object, $method, $parameters = array()){
        $reflectionClass = new ReflectionClass($object);
        $reflectionMethod = $reflectionClass->getMethod($method);
        $reflectionMethod->setAccessible(TRUE);
        
        return $reflectionMethod->invokeArgs($object, $parameters);
    }

    public function testCheckTextMatchPattern(){
        $result = $this->callPrivateMethod($this->article, "checkText");
        $this->assertTrue($result);
    }    
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage Text does not match pattern
     */    
    public function testCheckTextEmptyString(){
        $this->changeArticle();
        $this->callPrivateMethod($this->article, "checkText");
    }
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage Text does not match pattern
     */    
    public function testCheckTextThrowExceptionIfNotMatchPattern(){
        $this->changeArticle("Text not match pattern");
        $this->callPrivateMethod($this->article, "checkText");
    }
    
    public function testGetTitle(){
        $this->assertEquals("EUROLIGA DE BASCHET MASCULIN", $this->article->getTitle());
    }

    public function testGetIntro(){
        $this->assertEquals("Meciuri tari în etapa inaugurală a turneului Top 16", $this->article->getIntro());
    }
    
    public function testGetBeta(){
        $this->assertEquals("În grupele preliminare E și F ale turneului Top 16 din Euroliga de Baschet masculin în noul an au fost jucate 6 partide din etapa inaugurală.", $this->article->getBeta());
    }
   
}