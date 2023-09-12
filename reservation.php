<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.4/dist/simple-notify.min.css" />

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/simple-notify@0.5.4/dist/simple-notify.min.js"></script>
<?php
session_start();
require_once "config.php";

  function dateIsInBetween(\DateTime $from, \DateTime $to, \DateTime $subject)
{
    return $subject->getTimestamp() > $from->getTimestamp() && $subject->getTimestamp() < $to->getTimestamp() ? true : false;
}



// collect value of input field
/*   FOR DATETIME-LOCAL     ---------

$od = $_POST['od'];
$od = date_create($od)->format('Y-m-d H:i:s');
$do = $_POST['do'];
$do = date_create($do)->format('Y-m-d H:i:s');
$id = $_POST['id'];
 */
$same=false; 
$od = $_POST['od'];
$od = date_create($od)->format('Y-m-d');
$do = $_POST['do'];
$do = date_create($do)->format('Y-m-d');
$id = $_POST['id'];

$id_user = $_SESSION["id"];

$servername = "localhost";
$dbname = "straka07";
$username = "straka07";
$password = "Gdep14.89*";

                   

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $statement = $conn->prepare("SELECT `start`,`end` FROM `reservation` WHERE (`id_book`= :id ) AND (:start BETWEEN `start` AND `end` OR :end BETWEEN `start`AND `end`)");
    $statement->execute(array(':id' => $id,':start' => $od,':end' => $do));
    $row = $statement->fetchall(); // Use fetchAll() if you want all results, or just iterate over the statement, since it implements Iterator
    var_dump($row);
    foreach ($row as $zaznam){
        echo '<br>' ;
        echo $zaznam['start'].' => '.$zaznam['end'];
                echo '<br>' ;
             //   echo $id;
              
                $paymentDate       = new \DateTime('now');
                $contractDateBegin = new \DateTime($zaznam['start']);
                $contractDateEnd   = new \DateTime($zaznam['end']);

        if (dateIsInBetween($contractDateBegin, $contractDateEnd, $paymentDate)){
                echo "is between";
                $same=true;
                break;
              }  
    }
  


if($same===false){
  echo 'false';
                           


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO reservation (`id_user`, `id_book`, `start`, `end` ) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_user, $id, $od, $do]);

    echo "New record created successfully";
} catch (PDOException $e) {
  //  echo $sql . "<br>" . $e->getMessage();
    $_SESSION['message']="error";
  header('Location: view?id='.$id);
    exit;
}
$conn = null;
$_SESSION['message']="success";
header('Location: view?id='.$id);
exit;
       
   }else{
          echo'true';
       
$_SESSION['message']="error";
header('Location: view?id='.$id);
exit;     
      }
?>

