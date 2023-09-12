<!DOCTYPE html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
      integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<html lang="cz">
<link rel="stylesheet" href="css/view.css">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Knihovna</title>
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
        }
    </script>
    <style>


        .day {
            text-align: center;
            border: 1px solid black;

        }

        .contejner {

            left: 5%;
            right: 5%;
        }

        .center {
            text-align: center;
        }

        .book {
            margin auto;
            padding: 0;
            height: 100px;
            border: 1px solid whitesmoke;
        }


        .jmeno {
            overflow-wrap: break-word;
            max-width: 150px;
        }

        .event {

            position:absolute;
            width: 200px;
            height: 50px;

            margin: auto;
            padding: 0;

            background-color: orange;
        }
        th{
            text-align: center;
        }
    </style>
</head>
<body>
<?php
include "header.php";
?>
<br><br>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col"></th>
            <?php
            for ($i = 1; $i <= 30; $i++) {
                echo '     <th scope="col" colspan="2" >' . $i . '</th>';
            }
            ?>

        </tr>
        </thead>
        <tbody>
        <tr>
            <th class="jmeno" scope="row">Kniha Která má dlouhé jméno společně s atorem</th>
            <?php
           echo '<td  ondrop="drop(event)" ondragover="allowDrop(event)">
                      <div id="drag1" draggable="true" ondragstart="drag(event)" class="event">
                        asdasdasd
                       </div>

                 </td>';

            echo ' <td colspan=""   id="div'.$i.'" ondrop="drop(event)" ondragover="allowDrop(event)"></td>';
            for ($i = 2; $i <= 60; $i++) {

                // echo' <td '.(($i==1)?"colspan=\"25\"":null).' ></td>';
                if($i % 2 != 0){
                    echo ' <td colspan=""   id="div'.$i.'" ondrop="drop(event)" ondragover="allowDrop(event)"></td>';
                }else{
                    echo ' <td colspan=""  id="div'.$i.'" ondrop="drop(event)" ondragover="allowDrop(event)"></td>';
                }

            }
            ?>

        </tr>

        </tbody>
    </table>
</div>


</body>
</html>