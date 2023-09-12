<?php
// Check if the user is logged in
if (!isset($_POST['id'])) {
    header("location: users.php");
    exit;
}
$data = [];
$user_info['text'] = '';


$id = (($_POST['id']));
$id = preg_replace('/[^0-9]/', '', $id);
require_once "config.php";


$servername = "localhost";
$dbname = "straka07";
$username = "straka07";
$password = "Gdep14.89*";


$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$statement = $conn->prepare("SELECT `first_name`,`last_name`,`username`,`created_at`,`active` FROM users WHERE id=:id");
$statement->execute(array(':id' => $id));
$row = $statement->fetchall(); // Use fetchAll() if you want all results, or just iterate over the statement, since it implements Iterator
foreach ($row as $zaznam) {

    $data = $zaznam;
}


$book_info = getBook("SELECT ID, Nazev, Autor, Rok, Img_url FROM kniha WHERE Img_url not like '' LIMIT 10 OFFSET 10");
//$book_info=getBook('zapujcky',"WHERE Img_url not like '' LIMIT 10 OFFSET 10");
$reservation_info = getBook("SELECT kniha.ID, kniha.Nazev, kniha.Autor,kniha.Rok,kniha.Img_url FROM `kniha` JOIN reservation ON reservation.id_book = kniha.ID JOIN users ON users.id = reservation.id_user WHERE reservation.id_user = " . $id);


function getBook($sql)
{
    require "config.php";

    //$sql = "SELECT ID, Nazev, Autor,Rok,Img_url FROM ".$table." ".$where;

    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        $radek = 0;
        $count = 0;
        $user_info['text'] = '<div class="row">';
        while ($row = $result->fetch_assoc()) {
            $count++;
            $radek++;
            if ($radek > 3) {
                $user_info['text'] .= '</div>';
                $user_info['text'] .= '<div class="row">';
                $radek = 1;
            }

            $user_info['text'] .= '     <div class="col-sm item book_ram" >
            <a href="view?id=' . $row['ID'] . '">
            <div class="book"> <div class="smoler">

                    <div class="book_img">
                        <img src="' . $row['Img_url'] . '">
                    </div>
                    <div class="book_text">
                        <h5>' . $row['Nazev'] . '</h5>
                        <p class="book_description">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>&nbsp' . $row['Autor'] . '</p>
                        <p class="book_description">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path>
                            </svg>
        ' . (($row['Rok'] == 0) ? '' : $row['Rok']) . '</p>
                    </div>
                </div>
            </div>
            </a>
        </div>';

        }
        $user_info['text'] .= '</div>';
    } else {
        $_SESSION['message'] = 'empty';
    }
    $link->close();
    $user_info['count'] = $count;
    return $user_info;
}

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
        .padding {
            padding: 10px;
        }

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
        .float-right{
            float: right;
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
                    <div class="d-flex flex-column align-items-center text-center"><img
                                src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                class="rounded-circle" width="200">
                        <div class="mt-3"><h4><?php echo ($data['first_name']) . ' ' . ($data['last_name']); ?></h4>

                            <p class="text-muted font-size-sm">Muž</p>
                            <button class="btn btn-danger">Smazat</button>
                            <button class="btn btn-outline-primary" data-toggle="modal"
                                    data-target=".bd-example-modal-lge">Zpráva
                            </button>


                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3"><h6 class="mb-0">Jméno a příjmení</h6></div>
                        <div class="col-sm-9 text-secondary"><?php echo ($data['first_name']) . ' ' . ($data['last_name']); ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3"><h6 class="mb-0">Email</h6></div>
                        <div class="col-sm-9 text-secondary"><?php echo($data['username']); ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3"><h6 class="mb-0">Datum narození</h6></div>
                        <div class="col-sm-9 text-secondary"> (239) 816-9029</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3"><h6 class="mb-0">Telefonní číslo</h6></div>
                        <div class="col-sm-9 text-secondary"> (320) 380-4539</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3"><h6 class="mb-0">Adresa</h6></div>
                        <div class="col-sm-9 text-secondary"> Bay Area, San Francisco, CA</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target=".bd-example-modal-lg">Úprava profilu
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md">
                <div class="row">
                    <button class="col card grean_background switch" data-id="prectene">
                        <div class="card-body">
                            <div class="row">
                                <div class="col"><h2>Přečtené </h2></div>
                                <div class="col"><h2><?php echo $reservation_info['count']; ?></h2></div>
                            </div>

                        </div>
                   </button>
                    <button class="col card blue_background switch" data-id="zapujcene">
                        <div class="card-body">
                            <div class="row">
                                <div class="col"><h2>Zapůjčené </h2></div>
                                <div class="col"><h2><?php echo $reservation_info['count']; ?></h2></div>
                            </div>

                        </div>

                    </button>

                    <button class="col card yelow_background switch" data-id="rezervovane">

                        <div class="card-body">
                            <div class="row">
                                <div class="col"><h2>Rezervace </h2></div>
                                <div class="col"><h2><?php echo $reservation_info['count']; ?></php></h2></div>
                            </div>

                        </div>

                    </button>
                    <button class="col card other_background switch" data-id="zpozdene">

                        <div class="card-body">
                            <div class="row">
                                <div class="col"><h2>Zpožděné </h2></div>
                                <div class="col"><h2><?php echo $reservation_info['count']; ?></h2></div>
                            </div>

                        </div>

                    </button>
                </div>
            </div>


        </div>
        <div id="ajax">
            <?php
            // echo $book_info   ;
            echo $reservation_info['text'];
            ?>
        </div>
    </div>


</div>
<!-- Large modal -->

</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Zpráva</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="padding">

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
                                                                    class="btn btn-primary px-4 float-right"
                                                                    value="Uložit"></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lge" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Zpráva</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form class="padding">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email address</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1"
                           placeholder="name@example.com" value="<?php echo($data['username']); ?>">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Předmět</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1"
                           placeholder="Žádost">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Example textarea</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <input type="button" id="test"
                       class="btn btn-primary px-4"
                       value="Odeslat">
            </form>

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
    $(function () {
        $('#test').click(function () {

            var val = []
            val[0] = $("#jmeno").val();
            val[1] = $("#telefon").val();
            val[2] = $("#adresa").val();
            val[3] = $("#datumnarozeni").val();
            val[4] = <?php echo $id; ?>;
            val[5] = $("#prijmeni").val();

            $.ajax({
                url: 'metody/save_user.php',
                type: 'POST', // get method
                data: {formdata: val}, // download get name + value go
                success: function (data) {
                    // success
                    alert(JSON.stringify(data));
                },
                error: function (data) {
                    // error
                    alert(JSON.stringify(data));
                }
            });
        });
    });


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


    $(document).ready(function () {
        $("button.switch").click(function () {

            var dataId = $(this).attr("data-id");

            switch (dataId) {
                case 'prectene': {
                    var simple = '<?php echo json_encode($book_info['text']); ?>';
                    simple = simple.slice(1, -1);
                    $('#ajax').html("");
                    $('#ajax').html(simple);


                }
                    ;
                    break;
                case 'rezervovane': {

                    var simple = '<?php echo json_encode($reservation_info['text']); ?>';
                    simple = simple.slice(1, -1);
                    $('#ajax').html("");
                    $('#ajax').html(simple);

                }
                    ;
                    break;
                case 'zapujcene': {

                    var simple = '<?php echo json_encode($reservation_info['text']); ?>';
                    simple = simple.slice(1, -1);
                    $('#ajax').html("");
                    $('#ajax').html(simple);
                }
                    ;
                    break;
                case 'zpozdene': {
                    var simple = '<?php echo json_encode($book_info['text']); ?>';
                    simple = simple.slice(1, -1);
                    $('#ajax').html("");
                    $('#ajax').html(simple);


                }
                    ;
                    break;


            }


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