<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/header.css">
<?php
include "include/include.html";
?>

</head>
<body>
<div class="navs">
    <input type="checkbox" id="nav-check">
    <div class="nav-header">
        <div class="nav-title">
            Admin zobrazení
        </div>
    </div>
    <div class="nav-btn">
        <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>

    <div class="nav-links">
        <ul>
            <li><a href="katalog" >Knihy</a></li>
            <li><a href="#" >Kontakt</a></li>
            <li><a href="onas.php" >O nás</a></li>
            <li> <a href="<?php echo (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) ? 'logout' : 'login' ?>"
                   target="_blank"><?php echo (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) ? 'Odhlásit' : 'Přihlásit' ?></a>
            </li>
            

        </ul>
    </div>
</div>
</body>
</html>