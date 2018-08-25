<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 21/08/2018
 * Time: 13:19
 */
?>

<!--<nav class="navbar navbar-expand-lg navbar-light">-->
<!--    <a class="navbar-brand" href="#">Toledo Flights</a>-->
<!--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">-->
<!--        <span class="navbar-toggler-icon"></span>-->
<!--    </button>-->
<!--    <div class="collapse navbar-collapse" id="navbarNav">-->
<!--        <ul class="navbar-nav mr-auto">-->
<!--            <li class="nav-item active">-->
<!--                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">Features</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">Pricing</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link disabled" href="#">Disabled</a>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
<!--</nav>-->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Toledo Flights</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
        <ul class="navbar-nav mr-auto"></ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/register') }}">Register</a>
            </li>
        </ul>
    </div>
</nav>