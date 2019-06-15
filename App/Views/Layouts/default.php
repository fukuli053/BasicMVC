<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $this->siteTitle(); ?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= SROOT ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= SROOT ?>public/css/custom.css">
    <script src="<?= SROOT ?>public/js/jquery-3.4.1.min.js"></script>
    <script src="<?= SROOT ?>public/js/bootstrap.min.js"></script>

    <?= $this->content('head'); ?>

</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <?= $this->content('body'); ?>
    </div>
</body>

</html>