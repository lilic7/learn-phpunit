<?php
namespace Docx;
class Docx extends \ZipArchive{
    private $fileName;
    private $content;
    private $zip;

    public function __construct($fileName) {
        $this->zip = $this->open($fileName);
    }
    
    private function checkZip(){
        return ($this->zip && !is_numeric($this->zip)) ? TRUE : FALSE;
    }
    
    protected function locateDocumentXml(){
        return $this->locateName("word/document.xml");
    }

    private function cleanContent($docxContent){
        $content1 = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $docxContent);
        $content_clear = str_replace('</w:r></w:p>', "\r\n", $content1); 
        return trim(strip_tags($content_clear));
    }
            
    function getContent(){
        if($this->checkZip()){  
            $content = $this->getFromName('word/document.xml');
        }
        return $this->cleanContent($content);
    }
}
