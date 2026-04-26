<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo TITLE; ?> 500</title>
    <link href="http://<?php echo APP_HOST; ?>/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://<?php echo APP_HOST; ?>/public/css/error.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="error text-left"><?php echo $errorMessage; ?></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="http://<?php echo APP_HOST; ?>/public/js/popper.min.js"></script>
    <script src="http://<?php echo APP_HOST; ?>/public/js/bootstrap.min.js"></script>
    <script src="http://<?php echo APP_HOST; ?>/public/js/erros.js"></script>
</body>
</html>
