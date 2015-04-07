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
            echo "<textarea>".$docx->getContent()."</textarea>";
        ?>
    </body>
</html>
