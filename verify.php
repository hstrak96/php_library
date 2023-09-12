<?php
require_once "config.php";
$email = "";
$hash = $_GET["hash"];


$sql = "SELECT id,hash FROM users WHERE username = ?";

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_username);

    // Set parameters
    $param_username = trim($_GET["email"]);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        /* store result */
        mysqli_stmt_store_result($stmt);
        //  var_dump($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $id, $hashed_password);
            if (mysqli_stmt_fetch($stmt)) {

                var_dump($id);

                var_dump($hashed_password);
            }
            if (strcmp($hash, $hashed_password) == 0) {

                try {
                    $sql = "UPDATE users SET active=1 WHERE id=?";
                    if ($stmt = mysqli_prepare($link, $sql)) {
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "i", $param_id);

                        // Set parameters
                        $param_id = $id;


                        // Attempt to execute the prepared statement
                        if (mysqli_stmt_execute($stmt)) {
                            // Redirect to login page
                            header("location: login.php");
                        } else {
                            echo "Oops! Něco se nepodařilo. Prosím zkuste to později.";
                        }

                        // Close statement
                        mysqli_stmt_close($stmt);
                    }

                } catch (PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }

                $conn = null;
            }


        }
    } else {
        echo "Oops! Něco se nepodařilo. Prosím zkuste to později.";
    }

    // Close statement
    mysqli_stmt_close($stmt);

}
?>