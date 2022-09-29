<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Gradely ist das revolutionäre Notemanagement-Tool für Schüler, Lernende und Studenten">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <title><?= $title; ?> | Europa</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
        <button class="navbar-toggler navbar-toggler-button" type="button" data-toggle="collapse"
                data-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                aria-label="Toggle navigation">
            <img src="/images/menu-icon.png" class="navbar-toggler-icon navbar-toggler-image" alt="Menu">
        </button>
        <a href="/user">
            <img src="/images/logo.png" data-toggle="tooltip" title="Europa | Home"
                 class="navbar-brand navbar-brand-icon" alt="Europa Logo">
        </a>

        <?php

        use App\Authentication\Authentication;

        if (Authentication::isAuthenticated()) {
            echo '
        <div class="d-flex flex-row position-absolute navbar-icons">

                <a href="/user/profile" class="mx-3">
                    <img src="/images/avatar.svg" data-toggle="tooltip" title="My profile" width="32" alt="Profile icon">
                </a>

                <a href="/user/doLogout">
                    <img src="/images/exit.svg" id="logoutBtn" data-toggle="tooltip" title="Logout" width="32" alt="Logout icon">
                </a>
        </div>
        ';
        }
        ?>

        <div class="collapse navbar-collapse navbar-item-div" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <?php

                if (Authentication::isAuthenticated()) {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="/user">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/customer/search">Customers</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/customer/create">Add customer</a></li>
                            <li><a class="dropdown-item" href="/customer/search">Search customer</a></li>
                            <li><a class="dropdown-item" href="/customer/delete">Delete customer</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/item/search">Items</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/item/search">Search owner</a></li>
                            <li><a class="dropdown-item" href="/item/scan">Scan barcode</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/document/invoice">Documents</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/document/invoice">Create invoice</a></li>
                        <li><a class="dropdown-item" href="/document/stock">Create stock report</a></li>
                    </ul>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/settings">Settings</a>
                    </li>
                ';
                } else {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="/user/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/register">Registrieren</a>
                    </li>
                    ';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/default/about">About</a>
                </li>
                <?php
                if (Authentication::isAdmin()) {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Admin-Panel</a>
                    </li>
                        ';
                }
                ?>
            </ul>
        </div>

    </nav>
</header>

<main class="container text-center">
    <h1><?= $heading; ?></h1>
