<?php

function getCountOfBook()
{
    $picture_on_page = 52;
    return $picture_on_page;
}
function removeqsvar($url, $varname) {
    list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
    parse_str($qspart, $qsvars);
    unset($qsvars[$varname]);
    $newqs = http_build_query($qsvars);
    return $urlpart . '?' . $newqs;
}
function getActualPage()
{
    $page = 0;
    $pocet = getNumberOfResults();
    if (isset($_GET['page'])) {
        $page = $output = preg_replace('/[^0-9]/', '', $_GET['page']);
        if ($page > $pocet) {
            $page = $pocet;
        }
        return $page;
    } else {
        return 0;
    }

}

function getNumberOfResults()
{
    $picture_on_page = getCountOfBook();

    require "config.php";

    $sql = "SELECT COUNT(ID) as soucet FROM kniha WHERE Img_url not like ''";

    $result = $link->query($sql);
    $soucet = 0;
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $soucet = $row["soucet"];

        }
    } else {
        echo "0 results";
    }
    $link->close();
    return ceil($soucet / $picture_on_page);
}


function getBook()
{
    $picture_on_page = getCountOfBook();
    if (getActualPage() > 0) {
        $page = ((getActualPage()) * $picture_on_page) - $picture_on_page;
    } else {
        $page = $picture_on_page;
    }


    require "config.php";


    $sql = "SELECT ID, Nazev, Autor,Rok,Img_url FROM kniha WHERE Img_url not like '' LIMIT " . $picture_on_page . " OFFSET " . $page;

    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        $radek = 0;
        echo '<div class="row">';
        while ($row = $result->fetch_assoc()) {
            $radek++;
            if ($radek > 4) {
                echo '</div>';
                echo '<div class="row">';
                $radek = 1;
            }

            echo '     <div class="col-sm item padding_none" >
            <a href="view?id=' . $row['ID'] . '">
            <div class="book"> <div class="smoler">

                    <div class="book_img">
                        <img src="' . $row['Img_url'] . '">
                    </div>
                    <div class="book_text">
                        <h6>' . $row['Nazev'] . '</h6>
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
        echo '</div>';
    } else {
        echo "0 results";
    }
    $link->close();
}


include_once("headerwith_search.php");

?>

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
<link rel="stylesheet" href="css/katalog.css">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Knihovna</title>
    <style>
a{
    z-index: 9999;

}
.sidenav{
    z-index: 9999;
}
    </style>
</head>
<body>

<br>
<br>
<br>
<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url='';
?>
<div class="sidenav">
    <a href="<?php if(isset($_GET['action'])){echo removeqsvar($actual_link,'action');}else{}; ?>">filtry</a>
    <a href="<?php echo $url .= $url.(parse_url($url, PHP_URL_QUERY) ? '&' : '?').'do=b'; ?>" class="filer">Dostupnost</a>
     <a href="<?php echo 'katalog?'.http_build_query($_GET); ?>" class="filer">Rok vydání</a>
    <hr>
    <a href="#clients">Clients</a>
    <a href="#contact">Contact</a>
</div>

<div class="main">


    <div class="box center">


        <?php
        getBook();
        ?>
    </div>
</div>


<div class="footer">
    <ul>

        <?php
        $actual_page = getActualPage();
        $actual_page = ($actual_page == 0) ? 1 : $actual_page;
        $pocet = getNumberOfResults();
        $max = 5;
        $min = 1;


        if (($actual_page - 4) > 0) {
            $min = $actual_page - 4;
        }
        if ($actual_page + 4 < $pocet) {
            $max = $actual_page + 4;
        } else {
            $max = $pocet - 1;
        }

        if ($pocet < $max) {
            $max = $pocet - 1;
        }
        echo ' <a href="?page=' . (($actual_page - 1 > 0) ? ($actual_page - 1) : $actual_page) . '"><li class="arrow"><</li></a>';
        echo '<a href="?page=1"><li class="page ' . (($actual_page == 1) ? "active" : null) . '">1</li></a>';
        for ($i = $min + 1; $i <= $max; $i++) {
            echo '<a href="?page=' . $i . '"><li class="page ' . (($actual_page == $i) ? "active" : null) . '">' . $i . '</li></a>';

        }

        echo '<a href="?page=' . $pocet . '"><li class="page ' . (($actual_page == $pocet) ? "active" : null) . '">' . $pocet . '</li></a>
        <a href="?page=' . (($actual_page < $pocet) ? ($actual_page + 1) : $actual_page) . '"><li class="arrow">></li></a>';

        ?>
    </ul>
</div>
</body>
</html>
