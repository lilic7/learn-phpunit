<?php
namespace Article;
use Exception;
class ArticleSeparator {
    const PATERN = "/(.{10,})(Intro:|INTRO:|intro:)(.{50,})(Beta:|BETA:|beta:)(.+)/s";
    private $text;
    private $title;
    private $intro;
    private $beta;
    
    public function __construct($text) {
        $this->text = $text;
    }
    
    private function checkText(){
        $status = preg_match(self::PATERN, $this->text);
        if($status === 1 ){
            return TRUE;
        }elseif($status === 0){
            throw new Exception("Text does not match pattern");
        }else{
            throw new Exception("Error occur while comparing strings");
        }
    }
    
    public function getTitle(){
        $head = trim(preg_replace(self::PATERN, "$1", $this->text));
        $temp = explode("\n", $head);
        $this->title = $temp[0];
        return $this->title;
    }
    
    public function getIntro(){
        $this->intro = trim(preg_replace(self::PATERN, "$3", $this->text));
        return $this->intro;
    }
    
    public function getBeta(){
        $this->beta = trim(preg_replace(self::PATERN, "$5", $this->text));
        return $this->beta;
    }
    
    
}
