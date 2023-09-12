<?php
// Include config file
$link = mysqli_connect();
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $email = $confirm_password = $first_name = $last_name = "";
$username_err = $password_err = $confirm_password_err = $last_name_err = $first_name_err = "";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["username"]);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
    if (empty($_POST["first_name"])) {
        $first_name_err = "Prosím vyplňte jméno";
    }
    if (empty($_POST["last_name"])) {
        $last_name_err = "Prosím vyplňte příjmení";
    }
    $first_name = filter_var(trim($_POST["first_name"]), FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_var(trim($_POST["last_name"]), FILTER_SANITIZE_SPECIAL_CHARS);
    // Validate email
    if (empty(trim($_POST["username"]))) {
        $username_err = "Prosím vyplňte emailovou adresu.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $username_err = "Adresa obsahuje nepovolené znaky.";
    } else
        if (!preg_match('/^[a-zA-Z0-9_@.]+$/', trim($_POST["username"]))) {
            $username_err = "Adresa obsahuje nepovolené znaky.";
        } else {
            // Prepare a select statement
            $sql = "SELECT id FROM users WHERE username = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set parameters
                $param_username = trim($_POST["username"]);

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "Účet s tímto emailem již existuje";
                    } else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "Oops! Něco se nepodařilo. Prosím zkuste to později.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Prosím vyplňte heslo.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Heslo musí mít alespoň 6 znaků.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Prosím potvrďte heslo.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Hesla se neshodují.";
        }
    }

    // Check input errors before inserting in database
    if (condition) {
         # code...
     } (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($first_name_err) && empty($last_name_err)) {
        $hash = md5(rand(0, 1000));
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, first_name, last_name, hash) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_first_name, $param_last_name, $param_hash);

            // Set parameters
            $param_hash = $hash;
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

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


        $img = file_get_contents('images/email.png');
        $imgdata = base64_encode($img);
        //    $mailBody = "<img src='data:image/x-icon;base64,$imgdata'/>";
        //send email
        $to = $email;
        $subject = "Ověření";
        $mess = "http://195.113.207.163/~straka07/BP/verify.php?email=" . $to . "&hash=" . $hash . "";
        $message = '<title>HTML email</title>';
        $message .= file_get_contents("email/registration.php");
        // $message .= "<img src='data:image/x-icon;base64,$imgdata'/>";
        $message .= '
     <img src="data:image/x-icon;base64,' . $imgdata . '" alt="" style="width: 300px; max-width: 600px; height: auto; margin: auto; display: block;">
                </td>
            </tr><!-- end tr -->
            <tr>
                <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
                    <table>
                        <tr>
                            <td>
                                <div class="text" style="padding: 0 2.5em; text-align: center;">
                                    <h2>Prosím ověřte email</h2>
                                    <h3>Kliknutím na tlačítko níže ověřte</h3>
<p><a href="' . $mess . '" class="btn btn-primary">Ověřit email</a></p>';
        $message .= file_get_contents("email/registration_footer.php");
// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: <borovnice.knihovna@gmail.com>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }

    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
<html lang="en">
<link rel="stylesheet" href="css/login.css">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Registrace</title>
</head>

<body class="">
<div class=" container ">
    <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
            <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                <div class="card-img-left d-none d-md-flex">

                </div>
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title text-center mb-5 fw-light fs-1"><a href="login.php">Přihlášení</a>/Registrace
                    </h5>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="row">

                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" name="first_name"
                                           class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $first_name; ?>" id="floatingInputUsername"
                                           placeholder="myusername">
                                    <span class="invalid-feedback"><?php echo $first_name_err; ?></span>
                                    <label for="floatingInputUsername">Jméno</label></div>
                            </div>

                            <div class="col">
                                <div class="form-floating">
                                    <input name="last_name" type="text"
                                           class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $last_name; ?>" id="floatingInputUsername"
                                           placeholder="myusername">
                                    <span class="invalid-feedback"><?php echo $last_name_err; ?></span>
                                    <label for="floatingInputUsername">Příjmení</label></div>
                            </div>
                        </div>
                        <br>
                        <div class="form-floating mb-3">
                            <input type="text" name="username"
                                   class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                                   value="<?php echo $username; ?>" id="floatingInputEmail"
                                   placeholder="name@example.com">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            <label for="floatingInputEmail">Email address</label>
                        </div>

                        <hr>

                        <div class="form-floating mb-3">
                            <input type="password" name="password"
                                   class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                                   value="<?php echo $password; ?>" id="floatingPassword" placeholder="Password">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            <label for="floatingPassword">Password</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="confirm_password"
                                   class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                                   value="<?php echo $confirm_password; ?>" id="floatingPasswordConfirm"
                                   placeholder="Confirm Password">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            <label for="floatingPasswordConfirm">Confirm Password</label>
                        </div>

                        <div class="form-floating mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Souhlasím se <a href="">zpracování osboních údajů</a>
                                </label>
                            </div>

                        </div>

                        <div class="d-grid mb-2">
                            <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">
                                Register
                            </button>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <a href="#" class="fa fa-facebook"></a>
                            </div>
                            <div class="col">
                                <a href="#" class="fa fa-google"></a>
                            </div>
                            <div class="col">
                                <a href="#" class="fa fa-twitter"></a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col">
                         
                            </div>
                            <div class="col">

                            </div>
                            <div class="col">
                     
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


</html>

