<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <?php
    session_start();
 //  include "include/include.html";

    ?>
    <style>
        .search {
            text-align: center;
            display: inline-block;
            position: absolute;
            width: calc(100% - 566px);
            font-family: Arial, Helvetica, sans-serif;
            padding: 10px 10px 10px 10px;
            min-width: 200px;
        }

        #search {
            font-size: 22px;
            height: 100%;
            width: 80%;

        }

        @media (max-width: 750px) {
            .search {

                width: calc(100% - 290px);
                min-width: 10px;
                margin: 0;
                padding-right: 0;
                padding-left: 0;
            }

        }
    </style>
</head>
<body>
<div class="navs">
    <input type="checkbox" id="nav-check">
    <div class="nav-header">
        <div class="nav-title sidebarColl" >
            Knihovna borovnice
        </div>
    </div>
    <div class="nav-btn">
        <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
        </label>

    </div>
    <div class="search">
        <input id="search" type="text">
    </div>
    <div class="nav-links">

        <ul>
            <li><a href="katalog">Knihy</a></li>
            <li><a href="#" >Kontakt</a></li>
            <li><a href="onas.php" >O nás</a></li>
            <li>
                <a href="<?php echo (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) ? 'logout' : 'login' ?>"
                   target="_blank"><?php echo (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) ? 'Odhlásit' : 'Přihlásit' ?></a>
            </li>


        </ul>
    </div>
</div>
</body>
</html><script>
    $(document).ready(function () {
        $('.sidebarColl').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('.hidden_side').toggleClass('active');
        });
    });







</script>
