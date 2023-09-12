<?php
session_start();
require "headerwith_search.php";


if (isset($_GET['id'])) {
    $id = $output = preg_replace('/[^0-9]/', '', $_GET['id']);
}

echo '<br>';


require_once "config.php";

$sql = "SELECT * FROM kniha WHERE ID =" . $id;

$result = $link->query($sql);
$dotaz = "[";
if ($result->num_rows > 0) {
    $radek = 0;

    while ($row = $result->fetch_assoc()) {
        $data_local = $row;
        $dotaz .= "{\"isbn\":\"";
        $dotaz .= $row["ISBN"] . '"}';
        $dotaz .= ']';

    }
    echo '</div>';
} else {
    echo "0 results";
}
$link->close();
$data_local['Rok'] = ($data_local['Rok'] == 0) ? null : $data_local['Rok'];
$data_local['Vydal'] = (strcmp($data_local['Vydal'], $data_local['Autor']) == 0) ? null : $data_local['Vydal'];
$data = get_information($dotaz);


//----------GET data from ISO---------------

$vydal = $data['csn_iso_690'];
$pattern = "/[-\s:]/";
$components = preg_split($pattern, $vydal);

if (strpos($data['csn_iso_690'], 'vydání.') !== false) {
    $s = substr(strstr($vydal, 'vydání.'), 9, -1);
} else {
    $s = substr(strstr($vydal, 'vyd.'), 4, -1);
}

$pocet_stran = (strstr($s, 's. ', true));
$pocet_stran = strrpos($s, " ");

$a = 'How are you?';


$pattern = "/[-\s:]/";
$component = preg_split($pattern, $vydal);


for ($q = count($components); $q > 0; $q--) {
    if ($components[$q] == 's.' || $components[$q] == 'stran.') {

        $pocet_stran = $components[$q - 1];
        $q = 0;
    }
}


$data['nakladatelstvi'] = strstr($s, ',', true);
$data['pocet_stran'] = $pocet_stran;


function get_information($dotaz)
{
    $url = "http://cache.obalkyknih.cz/api/books?multi=$dotaz";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = '';

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);


    $resp = curl_exec($curl);
    $pokus = json_decode($resp, true);


    curl_close($curl);


    foreach ($pokus as $pok) {
        echo "<br><br>";
        $return = $pok;
    }


    return $return;
}


function get_book($dotaz)
{
    $url = "http://cache.obalkyknih.cz/api/books?multi=$dotaz";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = '';

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);


    $resp = curl_exec($curl);
    $pokus = json_decode($resp, true);


    curl_close($curl);


    foreach ($pokus as $pok) {
        $return = $pok['cover_preview510_url'];
    }
    echo "<br><br>";

    return $return;
}


?>
<!DOCTYPE html>

<!-- Alert -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.4/dist/simple-notify.min.css"/>
<link rel="stylesheet" href="simple-notify-master/dist/simple-notify.min.css"/>

<script src="https://cdn.jsdelivr.net/npm/simple-notify@0.5.4/dist/simple-notify.min.js"></script>
<script src="simple-notify-master/dist/simple-notify.min.js"></script>


<!-- ALERT -->


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
      integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<html lang="cz">
<link rel="stylesheet" href="css/view.css">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Knihovna</title>
    <style>
        .day {
            background-color: orange;
        }
        .select {
            background-color: grean;
        }

        .calendar {
            text-align: center;
        }
        
    </style>
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
    <script>
        $(document).ready(function () {
            $("input").change(function () {
                var x = document.getElementById("od").value;
                var date = new Date(x);
                date.setDate(date.getDate() + 30);
                $("#do").val(date.toISOString().substring(0, 10));
                document.getElementsByName("do")[0].max = date.toISOString().substring(0, 10);
            });
        });
    </script>
</head>
<body>

<div class="kontejner">
    <div class="row">
        <div class="col-sm img">
            <?php echo '    <img src="' . $data['cover_preview510_url'] . '"> '; ?>
        </div>
        <div class="col-sm text">
            <br>
            <h2><?php echo ($data['bib_title'] != null) ? $data['bib_title'] : $data_local['Nazev']; ?></h2>
            <p><?php echo ($data['bib_author'] != null) ? $data['bib_author'] : $data_local['Autor']; ?></p>
            <p><?php echo ($data_local['Vydal'] != null) ? $data_local['Vydal'] : $data['nakladatelstvi']; ?></p>
            <p><?php echo(($data['bib_year'] != '') ? $data['bib_year'] : $data_local['Rok']);
                echo('&nbsp&nbsp&nbsp&nbsp&nbsp<img class="stars" src="' . $data['rating_url'] . '">' . ($data['rating_count'] == 0) ? null : $data['rating_count'] . 'x'); ?></p>
            <p><?php echo ($data['pocet_stran'] != null) ? 'Počet stran: ' . $data['pocet_stran'] : null; ?></p>
            <p><?php echo ($data_local['Ilustroval'] != null) ? $data_local['Ilustroval'] : null; ?></p>


            <p>Obsah: </p>
            <p id="content"><?php echo $data['annotation']['html']; ?></p>
            <br>


            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                Rzervace
            </button>

            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">


                        <div class="container">
                            <h2>Rezervace</h2>
                            <form action="reservation.php" method="post">
                                <div class="row">
                                    <div class="col">
                                        <label for="od">Od</label>
                                        <input type="date" class="form-control " id="od"
                                               aria-describedby="emailHelp" name="od" required>

                                        <br>
                                    </div>
                                    <div class="col">
                                        <label for="do">Do</label>
                                        <input type="date" class="form-control " id="do" name="do" required>
                                        <small id="emailHelp" class="form-text text-muted">Maximální doba zápůjčky je 30
                                            dní tato doba zle na požádání prodloužit.</small>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Rezervovat</button>
                                <input type="hidden" name="id" value="<?php echo($_GET['id']); ?>">
                            </form>
                            <br>
                            <div class="container border calendar">
                                <!--    <div class="row">
                                       <div class="col">Po</div>
                                       <div class="col">Ut</div>
                                       <div class="col">St</div>
                                       <div class="col">Čt</div>
                                       <div class="col">Pá</div>
                                       <div class="col">So</div>
                                       <div class="col">Ne</div>
                                   </div>
                                          <div class="col">1</div>
                                           <div class="col">2</div>
                                           <div class="col">3</div>
                                           <div class="col">4</div>
                                           <div class="col">5</div>
                                           <div class="col">6</div>
                                           <div class="col">7</div>
                                         </div>
                                          <div class="row">
                                           <div class="col">8</div>
                                           <div class="col">9</div>
                                           <div class="col">10</div>
                                           <div class="col">11</div>
                                           <div class="col">12</div>
                                           <div class="col">13</div>
                                           <div class="col">14</div>
                                         </div>
                                          <div class="row">
                                           <div class="col">15</div>
                                           <div class="col">16</div>
                                           <div class="col">17</div>
                                           <div class="col">18</div>
                                           <div class="col">19</div>
                                           <div class="col">20</div>
                                           <div class="col">21</div>
                                         </div>
                                          <div class="row">
                                           <div class="col">22</div>
                                           <div class="col">23</div>
                                           <div class="col">24</div>
                                           <div class="col">25</div>
                                           <div class="col">26</div>
                                           <div class="col">27</div>
                                           <div class="col">28</div>
                                         </div>
                                   -->
                                <?php


                                $mesice = array(1 => 'Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec');


                                $firstDay = date('D', mktime(0, 0, 0, date('m'), 1));
                                $days = date('t');
                                echo '<div class="row"><div class="col"></div><div class="col">' . $mesice[date("n")] . '</div><div class="col"></div></div>';
                                $mesic = date("n");
                                generateCalendar($firstDay, $days, $mesic);


                                echo '</div><br>
                                     <div class="container border calendar">';
                                $firstDay = date('D', strtotime(date('m', strtotime('+1 month')) . '/01/' . date('Y')));
                                echo '<div class="row"><div class="col"></div><div class="col">' . $mesice[date("n") + 1] . '</div><div class="col"></div></div>';
                                $mesic = date("n") + 1;
                                $days = date('t', strtotime(date('m', strtotime('+1 month')) . '/01/' . date('Y')));
                                generateCalendar($firstDay, $days, $mesic);


                                echo '</div><br>
                                          <div class="container border calendar">';
                                $firstDay = date('D', strtotime(date('m', strtotime('+2 month')) . '/01/' . date('Y')));

                                echo '<div class="row"><div class="col"></div><div class="col">' . $mesice[date("n") + 2] . '</div><div class="col"></div></div>';
                                $mesic = date("n") + 2;
                                $days = date('t', strtotime(date('m', strtotime('+2 month')) . '/01/' . date('Y')));
                                generateCalendar($firstDay, $days, $mesic);
                                echo '</div>';
                                
                                 echo '</div><br>
                                          <div class="container border calendar">';
                                $firstDay = date('D', strtotime(date('m', strtotime('+3 month')) . '/01/' . date('Y')));

                                echo '<div class="row"><div class="col"></div><div class="col">' . $mesice[date("n") + 3] . '</div><div class="col"></div></div>';
                                $mesic = date("n") + 3;
                                $days = date('t', strtotime(date('m', strtotime('+3 month')) . '/01/' . date('Y')));
                                generateCalendar($firstDay, $days, $mesic);
                                echo '</div>';

                                function generateCalendar($firstDay, $days, $mesic)
                                {


                                    $servername = "localhost";
                                    $dbname = "straka07";
                                    $username = "straka07";
                                    $password = "Gdep14.89*";
                                    $id_user =  $_GET['id'];

                                    $reserved = [];

                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $statement = $conn->prepare("SELECT `start`,`end` FROM reservation WHERE (MONTH(`start`)= :mounth OR MONTH(`end`)= :mounth) AND `id_book` = :id");
                                    $statement->execute(array(':mounth' => $mesic,':id' => $id_user));
                                    $row = $statement->fetchall(); // Use fetchAll() if you want all results, or just iterate over the statement, since it implements Iterator
                                    foreach ($row as $zaznam) {
                                /*        echo '<br>';
                                        echo $zaznam['start'] . ' => ' . $zaznam['end'];
                                        echo '<br>';  */
                                        $timestamp = strtotime($zaznam['start']);
                                        $start_mesic = (date('m', $timestamp));
                                    //    echo 'start_mesic: ' . $start_mesic.' ';
                                        $timestamp = (date('d', $timestamp));

                                        $end = strtotime($zaznam['end']);
                                        $end_mesic = (date('m', $end));
                                        //echo $end_mesic;
                                        $end = (date('d', $end));

                                        if ($end_mesic != $mesic) {
                                            $end = 32;
                                        }

                                        if ($start_mesic < $mesic) {
                                            $timestamp = 1;
                                        }

                                        // echo    $timestamp;
                                        // echo $end;
                                        while ($timestamp != $end + 1 && $timestamp != $days + 1) {
                                          //  echo $timestamp . ' ';
                                            $reserved[] = $timestamp;
                                            $timestamp++;
                                        }
                                    }


                                    //echo array_search("red",$a);


                                    echo '<div class="row">
                                    <div class="col">Po</div>
                                    <div class="col">Ut</div>
                                    <div class="col">St</div>
                                    <div class="col">Čt</div>
                                    <div class="col">Pá</div>
                                    <div class="col">So</div>
                                    <div class="col">Ne</div>
                                </div>';


                                    $tyden = array(
                                        "Mon" => 0,
                                        "Tue" => 1,
                                        "Wed" => 2,
                                        "Thu" => 3,
                                        "Fri" => 4,
                                        "Sat" => 5,
                                        "Sun" => 6,
                                    );

                                    $day = 0;

                                    echo '<div class="row">';
                                    for ($j = 0; $j < $tyden[$firstDay]; $j++) {
                                        echo '<div class="col"></div>';
                                    }
                                    $actual = $tyden[$firstDay] + 1;
                                    for ($i = 1; $i <= $days; $i++) {
                                        
                                        if(array_search($i,$reserved)===false){
                                            echo '<div class="col date" data-mounth='.$mesic.'>' . $i . '</div>';
                                        }else{
                                            echo '<div class="col day " data-mounth='.$mesic.'>' . $i . '</div>';
                                        }

                                        if ($actual == 7) {
                                            $actual = 0;
                                            echo '</div>';
                                            if ($i < $days) {
                                                echo '<div class="row">';
                                            }

                                        }
                                        $actual++;
                                    }
                                    if ($actual != 1) {
                                        for ($j = 0; $j < 8 - $actual; $j++) {
                                            echo '<div class="col"></div>';
                                        }
                                    }
                                    echo '</div>';
                                }


                                ?>

                            </div>
                        </div>
                    </div>
                </div>


                <?php
                switch ($_SESSION['message']) {
                    case "success":
                        echo '<script type="text/javascript">jsFunction("success","Úspěšně","Rezervace byla uložena");</script>';
                        $_SESSION['message'] = null;
                        break;
                    case "error":
                        echo '<script type="text/javascript">jsFunction("error","Error","Záznam se nepodařilo uložit");</script>';
                        $_SESSION['message'] = null;
                        break;
                }


                ?>
            </div>
        </div>

    </div>
    <script>

        var today = new Date().toISOString().substring(0, 10);
        var max = new Date();
        max.setDate(max.getDate() + 90);
        document.getElementsByName("od")[0].min = today;
        document.getElementsByName("od")[0].max = max.toISOString().substring(0, 10);
        document.getElementsByName("do")[0].min = today;
        
    var first=0;
    var one=0,two=0    
        
        
        $(".date").on("click", function() {
    $(this).css("background", "green");
    var text = $(this).text();
          text=text+1;
          
            //  $('div:contains("'+text+'")').css('background-color', 'red');
          
          
    alert ($(this).data("mounth"));
})


    </script>
</body>
</html>



