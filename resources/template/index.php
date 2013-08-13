<?php

 use Service\View; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Site</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Le styles -->
        <link href="/style/theme/cerulean/bootstrap.min.css" rel="stylesheet">
        <link href="/style/theme/cerulean/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="/style/site.css" rel="stylesheet">
        <script src="/script/jquery-1.9.1.min.js"></script>
        <script src="/script/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-narrow">            
            <hr/><?= (isset($page)) ? View::add($page) : 'not page setted!'; ?><hr/>
        </div> <!-- /container -->
    </body>
</html>
