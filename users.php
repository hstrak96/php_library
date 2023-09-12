<?php

require_once "config.php";

$sql = "SELECT `id`,`first_name`,`last_name`,`username`,`created_at`,`active` FROM users WHERE 1";

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
    <title>Uživatelé</title>
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
     .padding {
            padding: 10px;
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
<?php
require_once("headerwith_search.php");
?>
<body>
<div class="wrapper">
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
            <li  class="active">
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

    <div class="down">


        <table id="example" class="table table-striped table-bordered hover" style="width:100%; "></table>

    </div>


</div>

       <!-- LARGE MODA -->

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

            <form class="padding">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email address</label>
                    <input type="email" class="form-control" 
                           placeholder="name@example.com" id="email" value="">
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


     var count = 0;
    var dataSet = <?php echo json_encode($data);  ?>

        $(document).ready(function () {
            $('#example').DataTable({
                data: dataSet,
                mark: true,
                pagging: false,
                columns: [
                    {title: "ID"},
                    {title: "Jméno"},
                    {title: "Příjmení"},
                    {title: "Email"},
                    {title: "Datum registrace"},
                    {
                        title: "Aktivovaný", render: function (data, type, row) {
                            var status = (data == 1) ? 'ANO' : ' <button type="button" class="btn btn-danger">' +
                                '                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">\\n\' +\n' +
                                '                                       <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>\\n\' +\n' +
                                '                                       <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>\\n\' +\n' +
                                '                                   </svg>' +
                                '                               </button>';
                            return status;
                        }
                    },
                    {
                        title: "Akce",
                        width: "140",
                        orderable: false,
                        "searchable": false,
                        class: "FlexiGrid--row-commandPanel FlexiGrid--row-commandPanel--static",
                        render: function (id, type, row) {
                            return '<button type="button" class="btn btn-warning">\n' +
                                '                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">\n' +
                                '  <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"></path>\n' +
                                '  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>\n' +
                                '  <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>\n' +
                                '</svg>' +
                                '</button>' +
                                                                                    
                                ' ' +
                                '<button type="button" class="btn btn-success message" class="btn btn-primary" data-id="'+(count++)+'" data-toggle="modal" data-target=".bd-example-modal-lg">\n' +
                                '    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">\n' +
                                '        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"></path>\n' +
                                '    </svg>' +
                                '</button>' +
                                ' ' +
                                '<form action="user_info.php" method="post">' +
                                '<input class="hidden_input" type="hidden" name="id" value="'+row[0]+'" readonly>' +
                                ' <button type="submit" class="btn btn-info">\n' +
                                '</form>\n' +
                                '                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-lg" viewBox="0 0 16 16">\n' +
                                '  <path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z"></path>\n' +
                                '</svg>\n' +
                                '</button>';


                        }
                    }
                ]
            });
        });
        
        
        $("body").on("click", ".message", function (e) {
        var id = $(this).data('id');
        var row = dataSet[id];
        $("input[id=email]").val(row[3]);
    });
</script>
</html>
