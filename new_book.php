<?php
// Check if the user is logged in

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/user_view.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Uživatel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- POKUS GRAFY-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <!-- Bootstrap CSS CDN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <link rel="stylesheet" href="css/style4.css">
    <style>
        .down {
            width: 100%;
            padding: 60px 40px 40px;
        }

        .card {
            margin: 5px;
        }

        h2 {
            color: #343a40;
            font-family: 'Roboto', sans-serif;
            text-align: center;
        }

        .grean_background {
            background-color: #31c4a8;
        }

        .yelow_background {
            background-color: #eea236;
        }

        .blue_background {
            background-color: #17a2b8;
        }

        .other_background {
            background-color: #dc3545;
        }

        .text {
            min-width: 200px;
        }

    </style>
</head>
<?php require_once("headerwith_search.php") ?>
<body>

<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar" class="side">
        <div class="sidebar-header sidebarCollapse" id="sidebarCollapse">
            <h3 class="sidebarCollapse">Knihovna Borovnice</h3>
            <strong class="sidebarCollapse">KB</strong>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="admin">
                    <i class="bi bi-graph-up"></i>
                    Přehled
                </a>
            </li>
            <li>

                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="bi bi-book-half"></i>
                    Knihy
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li><a href="books">Knihy</a></li>
                    <li><a href="zapujcky">Zápůjčky</a></li>
                    <li><a href="reservation_view">Rezervace</a></li>
                </ul>
            </li>
            <li>
                <a href="users">
                    <i class="bi bi-person-fill"></i>
                    Uživatelé
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicon glyphicon-link"></i>
                    Doplnění informací
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicon glyphicon-paperclip"></i>
                    Aktivita
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicon glyphicon-send"></i>
                    Oznámení
                </a>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li><a href="" class="download">nvm</a></li>
            <li><a href="" class="article">Back </a></li>
        </ul>
    </nav>

    <nav id="sidebar" class="hidden_side">
    </nav>

    <!-- Page Content Holder
    Page Content Holder -->

    <div class="container down">

        <div class="row">
            <div class="col-md card">
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Password</label>
                                <input type="password" class="form-control" id="inputPassword4">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Address 2</label>
                            <input type="text" class="form-control" id="inputAddress2"
                                   placeholder="Apartment, studio, or floor">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input type="text" class="form-control" id="inputZip">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Check me out
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


</div>
<!-- Large modal -->

</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="metody\save_user.php">
                        <div class="row mb-3">
                            <div class="col-sm-3"><h6 class="mb-0">Jméno</h6></div>
                            <div class="col-sm-9 text-secondary"><input type="text" id="jmeno" class="form-control"
                                                                        value="<?php echo($data['first_name']); ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3"><h6 class="mb-0">Příjmení</h6></div>
                            <div class="col-sm-9 text-secondary"><input type="text" id="prijmeni" class="form-control"
                                                                        value="<?php echo($data['last_name']); ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3"><h6 class="mb-0">Email</h6></div>
                            <div class="col-sm-9 text-secondary"><input type="text" id="email" class="form-control"
                                                                        value="<?php echo($data['username']); ?>"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><h6 class="mb-0">Datum narození</h6></div>
                            <div class="col-sm-9 text-secondary"><input type="text" id="datumnarozeni"
                                                                        class="form-control"
                                                                        value="(239) 816-9029"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><h6 class="mb-0">Telefonní číslo</h6></div>
                            <div class="col-sm-9 text-secondary"><input type="text" id="telefon" class="form-control"
                                                                        value="(320) 380-4539"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><h6 class="mb-0">Address</h6></div>
                            <div class="col-sm-9 text-secondary"><input type="text" id="adresa" class="form-control"
                                                                        value="Bay Area, San Francisco, CA"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary"><input type="button" id="test"
                                                                        class="btn btn-primary px-4"
                                                                        value="Uložit"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
switch ($_SESSION['message']) {
    case "empty":
        echo '<script type="text/javascript">jsFunction("varning","Úspěšně","Nebyli nalezeny záznamy");</script>';
        $_SESSION['message'] = null;
        break;
    case "error":
        echo '<script type="text/javascript">jsFunction("error","Error","Záznam se nepodařilo uložit");</script>';
        $_SESSION['message'] = null;
        break;
}


?>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<!-- Bootstrap Js CDN -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">


    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('.hidden_side').toggleClass('active');
        });
    });
    $(document).ready(function () {
        $('.sidebarColl').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('.hidden_side').toggleClass('active');
        });
    });


</script>
</body>
</html>
<script type="text/javascript">
    function jsFunction(type, title, text) {
        new Notify({
            status: type,
            title: title,
            text: text,
            effect: 'fade',
            speed: 300,
            customClass: '',
            customIcon: '',
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 3000,
            gap: 20,
            distance: 20,
            type: 1,
            position: 'left bottom',
            customWrapper: '',
        })
    }
</script>