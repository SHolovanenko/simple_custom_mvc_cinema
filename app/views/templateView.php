<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <meta name="description" content="<?php echo $description; ?>" />
        <!-- Bootstrap -->
        <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet">

        <style>
            
        </style> 
         
    </head>
    <body>
        <div class="container">
            <?php 
                if (isset($data['exception'])) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $data['exception']; ?>
                    </div>
                    <?php
                }

                include 'app/views/'.$contentView; 
            ?>
        </div>
        
        <!-- Bootstrap -->
        <script src="/js/jquery-3.4.1.slim.min.js"></script>
        <script src="/js/bootstrap/bootstrap.bundle.js"></script>
    </body>
</html>
