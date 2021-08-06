<?php 
    include 'model/database.php';
    include 'model/utf8tourl.php';
    include 'controller/objects/object.php';
    function head($title) {
        echo '
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'.$title.'</title>
            <link rel="stylesheet" href="views/assets/css/style.css">
        ';
    }
?>