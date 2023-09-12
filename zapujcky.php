<?php

require_once "config.php";

$sql = "SELECT kniha.Nazev,users.first_name,users.last_name,zapujcky.start,zapujcky.end,users.username
FROM `zapujcky`
INNER JOIN kniha ON zapujcky.id_book=kniha.ID
INNER JOIN users ON users.id=zapujcky.id_user";

$result = $link->query($sql);
$dotaz = "[";
if ($result->num_rows > 0) {
    $data = [];

    while ($row = $result->fetch_assoc()) {

        $data[] = array_values((array)$row);

    }
} else {
    echo "0 results";
}
$link->close();


?>
<!DOCTYPE html>
<html>
<head>
    <title>Zápůjčky</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- POKUS GRAFY-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <!-- Bootstrap CSS CDN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <!-- POKUS  -->
    <!-- Our Custom CSS -->


    <link rel="stylesheet" href="css/style4.css">

    <style>
        .col {
            width: auto;
        }

        .down {
            width: 100%;
            padding: 60px 40px 40px;

        }


    </style>

</head>
<?php require_once("headerwith_search.php"); ?>
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
            <li class="active">

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

    <!-- Page Content Holder -->

    <div class="down">


        <table id="example" class="table table-striped table-bordered hover" style="width:100%; "></table>

    </div>


</div>


</body>
<!--                        Mark na vyhledavani                                -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.min.css">
<script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>

<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('.hidden_side').toggleClass('active');
        });
    });

    var dataSet = <?php echo json_encode($data);  ?>

        $(document).ready(function () {
            $('#example').DataTable({
                data: dataSet,
                mark: true,
                pagging: false,
                columns: [
                    {title: "Název díla"},
                    {title: "Jméno"},
                    {title: "Příjmení"},
                    {title: "Od"},
                    {title: "Do"},
                    {title: "Email"},
                    {title: "Akce",
                        width:"90px",
                        orderable: false,
                        "searchable": false,
                        class: "FlexiGrid--row-commandPanel FlexiGrid--row-commandPanel--static",
                        render: function (id, type, row) {
                            return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">\n' +
                                '    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">\n' +
                                '        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>\n' +
                                '        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>\n' +
                                '    </svg>\n' +
                                '    \n' +
                                '</button>\n' +
                                '\n' +
                                '<button type="button" class="btn btn-danger">\n' +
                                '    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">\n' +
                                '        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>\n' +
                                '        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>\n' +
                                '    </svg>\n' +
                                '    \n' +
                                '</button>';
                        }
                    }
                ]
            });
        });

</script>
</html>
