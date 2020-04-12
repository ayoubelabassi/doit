<?php
require_once __DIR__ . "/../domain/Employee.php";
require_once __DIR__ . "/../domain/Doctor.php";
session_start();

$errors = [];

if (isset($_GET['logout'])) {
    $_SESSION["user_id"] = null;
    $_SESSION["role"] = null;
    $_SESSION["name"] = null;
}

if (isset($_POST["ok"])) {
    $login = $_POST["username"];
    $password = $_POST["password"];
    $employee = Employee::findOneByLoginAndPassword($login, $password);
    if ($employee->id != null) {
        $_SESSION["user_id"] = $employee->id;
        $_SESSION["role"] = "employee";
        $_SESSION["name"] = $employee->firstName . ' ' . $employee->lastName;

        header("Location:appointment.php");
    } else {
        $doctor = Doctor::findOneByLoginAndPassword($login, $password);
        if ($doctor->id != null) {
            $_SESSION["user_id"] = $doctor->id;
            $_SESSION["role"] = "doctor";
            $_SESSION["name"] = $doctor->firstName . ' ' . $doctor->lastName;
            header("Location:appointment.php");
        } else {
            $errors[] = "Login ou mot de passe est incorrect!";
        }
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
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
            <form class="login100-form validate-form flex-sb flex-w" method="post">
					<span class="login100-form-title p-b-32">
						Authentication
					</span>
                <?php
                foreach ($errors as $error) {
                    echo "<div  class='alert alert-danger w-100 mb-2 mt-1' role='alert'>$error</div>";
                }
                ?>
                <span class="txt1 p-b-11">Username</span>
                <div class="wrap-input100 validate-input m-b-36" requied data-validate="Username is required">
                    <input class="input100" type="text" name="username">
                    <span class="focus-input100"></span>
                </div>
                <span class="txt1 p-b-11">Password</span>
                <div class="wrap-input100 validate-input m-b-12" requied data-validate="Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100"></span>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn w-100 mt-3" name="ok">
                        Login
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>
<script src="../assets/js/jquery.3.2.1.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/main.js"></script>

</body>
</html>