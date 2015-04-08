<!DOCTYPE html>
<?php require_once 'vendor/autoload.php';?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $path = __DIR__."\\tests\\modules\\Docx\\files\\SIGUR DE CALIFICARE.docx";
            $docx = new \Docx\Docx($path);
            $content = $docx->getContent();
            $article = new \Article\ArticleSeparator($content);
            echo "<textarea>".$docx->getContent()."</textarea>".$article->getTitle()."<textarea>".$article->getIntro()."</textarea>"."<textarea>".$article->getBeta()."</textarea>";
        ?>
    </body>
</html>
