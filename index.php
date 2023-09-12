<?php
// Initialize the session
session_start();

// Check if the user is logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<html lang="cz">

<link rel="stylesheet" href="css/login.css">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Knihovna</title>
<style>
#logo{
    height: 140px;
}
    .row{

        text-align: center;

    }
    #K{
        display: inline;
        color:#282d32;
        font-size: 125px ;
        font-family: 'Rockwell', sans-serif;
        font-weight: bold;
    }
    #B{
        display: inline;
        color:#31c4a8;
        font-size: 125px ;
        font-family: 'Rockwell', sans-serif;
        font-weight: bold;

    }
    .space{
        height: 170px;
    }
    .space-smaler{
        height: 150px;
    }
    .white{
        background-color: white;
    }
.knihovna{
    display: inline;
    color:#282d32;
    font-family: 'Rockwell', sans-serif;
    font-weight: bold;
}

    .color{
        display: inline;
        color:#31c4a8;
        font-family: 'Rockwell', sans-serif;
        font-weight: bold;
    }
    #mezera{
        height: 50px;
    }




</style>
</head>
<body class="">
<?php
require_once("header.php");
?>


<div class="row white">
    <div class="space-smaler">

    </div>
</div>
    <div class="row white">
        <div class="col">
        </div>
        <div class="col" id="logo">
            <div id="K">K</div><div id="B">B</div>
        </div>
        <div class="col">
        </div>
    </div>
<div class="row white center" id="mezera">

    <div class="col" id="logo">
        <h3><div class="knihovna">Knihovna</div><div class="color"> Borovnice</h3>
    </div>

</div>
<div class="row white">
    <div class="col">
    </div>
    <div class="col" id="logo">
        <form>
        <div class="form-group">
            <input type="search" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Vyhledejte...">
            <small id="emailHelp" class="form-text text-muted">Vyhledejte literaturu podle názvu nebo jeho částí.</small>
        </div>
        </form>
    </div>
    <div class="col">
    </div>
</div>
<div class="row">
<div class="space">

</div>

</div>

<?php
require_once("show.html"); ?>




<div class="space">

</div>

</body>

<?php
require_once ("footer.php");
?>
</html>