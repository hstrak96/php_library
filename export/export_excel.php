<?php





$host="localhost";
$username="korbel05";
$password="Gdep14.89*";
$databasename="korbel05";

$connect=mysql_connect($host,$username,$password);
$db=mysql_select_db($databasename);

$i=0;
$select = mysql_query("SELECT * FROM `kniha` WHERE 1 LIMIT 20");
while($row=mysql_fetch_array($select))
{
    $i++;
    $customers_data[$i]['nazev'] = ($row['Nazev']);
    $customers_data[$i]["autor"] = ($row['Autor']);
    $customers_data[$i]["ISBN"] = ($row['ISBN']);
    $customers_data[$i]["Pocet"] = ($row['pocet']);

}



//headers
header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Description: File Transfer');
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename=export.csv;');
header('Content-Transfer-Encoding: binary');

//open file pointer to standard output
$fp = fopen('php://output', 'w');

//add BOM to fix UTF-8 in Excel
fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
if ($fp)
{
    fputcsv($fp, array("Cars", "Planes", "Ships", "Pocet", "Aktuálně"), ";");
    foreach ($customers_data as $cus){
           fputcsv($fp, $cus, ";");
    }


}

fclose($fp);
?>

