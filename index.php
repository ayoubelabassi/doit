<?php
require_once __DIR__ . "/domain/Patient.php";
session_start();
$errors = [];
if (isset($_GET['logout'])) {
    $_SESSION["user_id"] = null;
    $_SESSION["role"] = null;
    $_SESSION["name"] = null;
}

if (isset($_POST["ok"])) {
    $number = $_POST["insuranceNumber"];
    $birthday = $_POST["birthday"];
    $patient = Patient::findOneByInsuranceAndBirthDay($number, $birthday);
    if ($patient->id != null) {
        $_SESSION["user_id"] = $patient->id;
        $_SESSION["role"] = "patient";
        $_SESSION["name"] = $patient->firstName . ' ' . $patient->lastName;

        header("Location:appointments.php");
    } else {
        $errors[] = "Numéro d'assurance ou date naissance est incorrect!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V14</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!--===============================================================================================-->
</head>
<body id="body">

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
            <form class="login100-form validate-form flex-sb flex-w" method="post">
					<span class="login100-form-title p-b-32">
						Authentication
					</span>
                <?php
                foreach ($errors as $error) {
                    echo "<div  class='alert alert-danger w-100 mb-2 mt-1' role='alert'>$error
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                          </div>";
                }
                ?>
                <span class="txt1 p-b-11">Numéro d'assurance</span>
                <div class="wrap-input100 validate-input m-b-36" requied data-validate="Numéro d'assurance is required">
                    <input class="input100" type="text" name="insuranceNumber">
                    <span class="focus-input100"></span>
                </div>
                <span class="txt1 p-b-11">Date naissance</span>
                <div class="wrap-input100 validate-input m-b-12" requied data-validate="Date naissance is required">
                    <input class="input100" type="date" name="birthday">
                    <span class="focus-input100"></span>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn w-100 mt-3" name="ok">
                        Valider
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<div id="dropDownSelect1"></div>
<script src="assets/js/jquery.3.2.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>