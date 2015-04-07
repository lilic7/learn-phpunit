<?php
use Article\ArticleSeparator;

class ArticleSeparatorTest extends PHPUnit_Framework_TestCase{
    private $article;
    
    protected function setUp() {
        $this->article = new ArticleSeparator;
    }

    public function testArticleHasNeededForm(){
        $this->assertRegExp("/(.{10,})(Intro:|INTRO:|intro:)(.{50,})(Beta:|BETA:|beta:)(.+)/", $this->article->checkArticle());
    }
}