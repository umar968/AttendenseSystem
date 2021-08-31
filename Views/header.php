<?php $config = parse_ini_file('config/config.ini'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" type="text/css" href="<?php echo $config['url'] . "public/css/styles.css" ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.css">

    <script src="<?php echo $config['url'] . 'public/js/index.js' ?>"></script>
    <title>Login</title>
</head>


<body>