  <?php


 @header("Content-Disposition: attachment; filename=mysql_to_excel.csv");

 $host="localhost";
 $username="korbel05";
 $password="Gdep14.89*";
 $databasename="korbel05";
 
 $connect=mysql_connect($host,$username,$password);
 $db=mysql_select_db($databasename);	


 $select = mysql_query("SELECT * FROM `kniha` WHERE 1 LIMIT 20");
 while($row=mysql_fetch_array($select))
 {
 echo implode("\t", ($row['Nazev']));
 echo implode("\t", ($row['Autor']));
 echo implode("\t", ($row['ISBN']));
 }


 exit();

?>

