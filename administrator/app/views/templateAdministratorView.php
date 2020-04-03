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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/administrator">Cinema</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/administrator/movie/all">Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/administrator/moviesession/all">Movie Sessions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/administrator/logout">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <?php
        if (isset($data['exception'])) {
        ?>
            <div class="alert alert-danger m-5" role="alert">
                <?php echo $data['exception']; ?>
            </div>
        <?php
        }

        include 'app/views/' . $contentView;
        ?>
    </div>

    <!-- Bootstrap -->
    <script src="/js/jquery-3.4.1.slim.min.js"></script>
    <script src="/js/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>