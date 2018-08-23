<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 21/08/2018
 * Time: 13:19
 */
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $page_title; ?></title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- our custom CSS -->
    <link rel="stylesheet" href="/assets/custom.css" />

</head>
<body>

<!-- container -->
<div class="container">

    <?php
        // show page header
        echo "<div class='page-header'>
                 <h1>{$page_title}</h1>
              </div>";
    ?>
