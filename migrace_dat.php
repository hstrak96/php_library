<?php
/*$i=2808;
for($i;$i>1;$i--){
}
$url=(getBook(30));
echo $url;
update($url,30);
if($url!=0){

}*/

search_by_name(34);


function search_by_name($id)
{
    $servername = "localhost";
    $username = "straka07";
    $password = "Gdep14.89*";
    $dbname = "straka07";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $dotaz = '[';
    $first = 1;

    $sql = "SELECT `Nazev`,`ISBN`,`Rok`,`Autor` FROM `kniha` WHERE id=" . $id;
    $result = $conn->query($sql);
    $i = 0;
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $i++;
            if ($first === 1) {
                $first = 2;
                $dotaz .= "{\"isbn\":\"";
                $dotaz .= $row["ISBN"] . '"';
                $dotaz .= "{\"bib_author\":\"";
                $dotaz .= $row["Autor"] . '"';
                $dotaz .= "{\"bib_title\":\"";
                $dotaz .= $row["Nazev"] . '"}';
            } else {
                $dotaz .= ",{\"isbn\":\"";
                $dotaz .= $row["ISBN"] . '"';
                $dotaz .= "{\"bib_author\":\"";
                $dotaz .= $row["Autor"] . '"';
                $dotaz .= "{\"bib_title\":\"";
                $dotaz .= $row["Nazev"] . '"}';
            }

            $dotaz .= ']';

            echo $dotaz;
            return dotaz2($dotaz);


        }
        return dotaz2($dotaz);
    } else {
        echo "0 results";
    }

    $conn->close();
    $dotaz .= ']';
    dotaz($dotaz);
}


function update($url, $id)
{
    $servername = "localhost";
    $username = "straka07";
    $password = "Gdep14.89*";
    $dbname = "straka07";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE kniha SET Rok='" . $url . "' WHERE id=" . $id;

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}


function getBook($start)
{
    $servername = "localhost";
    $username = "straka07";
    $password = "Gdep14.89*";
    $dbname = "straka07";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $dotaz = '[';
    $first = 1;

    $sql = "SELECT `Nazev`,`ISBN`,`Rok` FROM `kniha` WHERE id=" . $start;
    $result = $conn->query($sql);
    $i = 0;
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $i++;
            if ($first === 1) {
                $first = 2;
                $dotaz .= "{\"isbn\":\"";
                $dotaz .= $row["ISBN"] . '"}';
            } else {
                $dotaz .= ",{\"isbn\":\"";
                $dotaz .= $row["ISBN"] . '"}';
            }

            $dotaz .= ']';

            echo $row['Rok'];
            if ($row['Rok'] == 0) {
                return dotaz($dotaz);
            } else {
                return 0;
            }


        }
        return dotaz($dotaz);
    } else {
        echo "0 results";
    }

    $conn->close();
    $dotaz .= ']';
    dotaz($dotaz);
}


function dotaz($dotaz)
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


    echo '<div class="row">';
    echo '<br><hr>';
    echo '<br>';
    foreach ($pokus as $pok) {
        echo "api: " . $pok['bib_year'] . "<br>";
        $return = $pok['bib_year'];
    }


    return $return;
}

function dotaz2($dotaz)
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


    echo '<br><hr>';
    echo '<br>';
    foreach ($pokus as $pok) {
        var_dump($pok);
        $return = $pok['bib_year'];
    }


    return $return;
}


?>