<?php

require_once "config.php";

$sql = "SELECT `ID`,`Nazev`,`Autor`,`Jazyk`,`Rok`,`Vydal`,`ISBN` FROM kniha WHERE 1";

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
    <title>Knihy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- POKUS GRAFY-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Bootstrap CSS CDN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
            crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <!-- POKUS  -->
    <!-- Our Custom CSS -->


    <link rel="stylesheet" href="css/style4.css">

    <style>
        .floatr-right {
            float: left;
        }

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
        <div class="row">
        <a href="new_book.php" class="btn btn-outline-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"></path>
            </svg>
            <b>Nová kniha</b>
        </a>
            <a href="export/export_excel.php"><button type="button" class="btn btn-outline-primary">
            <i class="bi bi-download"></i>
           <b>Stáhnout</b>
                </button></a>

        </div>
        <br><br>

        <table id="example" class="table table-striped table-bordered hover" style="width:100%; "></table>

    </div>


</div>
<!-- Large modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>-->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container">
                <div class="row">
                    <div class="col-md card">
                        <div class="card-body">
                            <form>
                                <h1>Nová kniha</h1>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Název</label>
                                        <input type="text" class="form-control" id="nazev">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Autor</label>
                                        <input type="text" class="form-control" id="autor">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail4">ISBN</label>
                                        <input type="text" class="form-control" id="isbn">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputPassword4">Rok vydání</label>
                                        <input type="text" class="form-control" id="rok">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Nakladatelství</label>
                                        <input type="text" class="form-control" id="nakladateslstvi">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Jazyk</label>
                                        <input type="text" class="form-control" id="jazyk">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">EAN</label>
                                        <input type="text" class="form-control" id="ean">
                                    </div>
                                </div>

                        </div>
                                <button type="submit" class="btn btn-primary">Uložit</button>
                        <br>
                             </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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

    $('.edit').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('.hidden_side').toggleClass('active');
    });


    var count=1;
    var dataSet = <?php echo json_encode($data);  ?>

        $(document).ready(function () {
            $('#example').DataTable({
                data: dataSet,
                mark: true,
                pagging: false,
                columns: [
                    {title: "ID"},
                    {
                        title: "Název",
                        render: function (id, type, row) {
                            return '<a href="http://195.113.207.163/~straka07/BP/view?id=' + row[0] + '">' + row[1] + '</a>';
                        }
                    },
                    {title: "Autor"},
                    {title: "Jazyk"},
                    {title: "Rok vydání"},
                    {title: "Nakladatelství"},
                    {title: "ISBN"},
                    {
                        title: "Akce",
                        width: "90",
                        orderable: false,
                        "searchable": false,
                        class: "FlexiGrid--row-commandPanel FlexiGrid--row-commandPanel--static",
                        render: function (id, type, row) {
                            return '<button type="button" class="btn btn-primary edit" data-toggle="modal" data-nazev="'+row+'" data-id="'+(count++)+'" data-target=".bd-example-modal-lg">\n' +
                                '    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">\n' +
                                '        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>\n' +
                                '        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>\n' +
                                '    </svg>\n' +
                                '    \n' +
                                '</button>\n' +
                                '\n' +
                                '<button type="button" id="delete" class="btn btn-danger Command delete">\n' +
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
    $("body").on("click", ".edit", function (e) {
        var id = $(this).data('id');
        var row = dataSet[id];

        $("input[id=nazev]").val(row[1]);
        $("input[id=autor]").val(row[2]);
        $("input[id=rok]").val(row[4]);
        $("input[id=nakladateslstvi]").val(row[5]);
        $("input[id=isbn]").val(row[6]);
        $("input[id=jazyk]").val(row[3]);
    });


    $("body").on("click", ".Command.delete", function (e) {
        res = confirm("Opravdu si přejete smazat tento záznam.");
        if (res != true) {
            e.preventDefault();
        }
    });
</script>
</html>




