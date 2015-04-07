<?php
use Docx\Docx;

class DocxTest extends PHPUnit_Framework_TestCase {
    
    protected $zip;
    protected $docx;
    
    protected function setUp() {
        $this->changeFile("SIGUR DE CALIFICARE 1.docx");
    }
    
    protected function changeFile($fileName){
        $path = __DIR__."\\files\\$fileName";        
        $this->docx = new Docx($path);
    }
    
    protected function callPrivateMethod($object, $method, $parameters = array()){
        $reflectionClass = new ReflectionClass($object);
        $reflectionMethod = $reflectionClass->getMethod($method);
        $reflectionMethod->setAccessible(TRUE);
        
        return $reflectionMethod->invokeArgs($object, $parameters);
    }
    
    public function testAttributes(){
        $this->assertClassHasAttribute("fileName", "Docx\Docx");
        $this->assertClassHasAttribute("content", "Docx\Docx");
    }
    
    public function testDocxClassIsInstanceOfZipArchiveClass(){
        $this->assertInstanceOf("ZipArchive", $this->docx);
    }
    
    public function testCheckZip(){
        $result = $this->callPrivateMethod($this->docx, "checkZip");
        $this->assertTrue($result);
    }
    
    public function testCheckZipOnWrongFileFormat(){
        $this->changeFile("WrongExtension.doc");
        $result = $this->callPrivateMethod($this->docx, "checkZip");
        $this->assertFalse($result);
    }
    
    public function testZipHasDocumentXmlEntry(){
        $result = $this->callPrivateMethod($this->docx, "locateDocumentXml");
        $this->assertInternalType("integer", $result);
    }
    
    public function testWrongXml(){
        $this->changeFile("badFile.docx");
        $result = $this->callPrivateMethod($this->docx, "locateDocumentXml");
        $this->assertFalse($result);
    }
    
    public function testgetContentReturnText(){
        $this->assertEquals("SIGUR DE CALIFICARE", $this->docx->getContent());
    }
}