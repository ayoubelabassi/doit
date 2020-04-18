<?php
require_once __DIR__ . "/../domain/Employee.php";
require_once __DIR__ . "/../domain/Doctor.php";

$modals = "";
$emp = new Employee();
$doctors = Doctor::getAllDoctors();
if (isset($_POST["ok"])) {
    $emp->firstName = $_POST["firstName"];
    $emp->lastName = $_POST["lastName"];
    $emp->phone = $_POST["phone"];
    $emp->email = $_POST["email"];
    $emp->zip = $_POST["zip"];
    $emp->city = $_POST["city"];
    $emp->address = $_POST["address"];
    $emp->login = $_POST["login"];
    $emp->password = $_POST["password"];
    $emp->doctor = $_POST["doctor"];
    if (isset($_GET["id"])) {
        $emp->id = $_GET["id"];
    }
    $emp->save();
    header("Location:employee.php");
} else {
    if (isset($_GET["id"])) {
        $emp = Employee::findOneById($_GET["id"]);
    }
}

$title = 'Angestellter';
$nav = "employee";

$doctorItems = "";
foreach ($doctors as $doctor) {
    $doctorItems .= "
    <option value='$doctor->id'>$doctor->firstName $doctor->lastName</option>
            ";
}

$content = <<<EOD
<form method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header"><?php echo "hello"; ?>
                    <h5>Angestellter hinzufügen oder ändern</h5>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nachname</label>
                                <input type="text" name="lastName" required class="form-control" value="$emp->lastName">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Vorname</label>
                                <input type="text" name="firstName" required class="form-control" value="$emp->firstName">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Stadt</label>
                                <input type="text" name="city" required class="form-control" value="$emp->city">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Postleitzahl</label>
                                <input type="number" name="zip" required class="form-control" value="$emp->zip">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Adresse</label>
                                <textarea type="text" name="address" required class="form-control">$emp->address</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tél-Nr.</label>
                                <input type="tel" name="phone" required class="form-control" value="$emp->phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" required class="form-control" value="$emp->email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Arztname</label>
                                <select type="text" name="doctor" class="form-control" >$doctorItems</select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Login</label>
                                <input type="text" name="login" required class="form-control" value="$emp->login">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Passwort</label>
                                <input type="password" name="password" required class="form-control" value="$emp->password">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group mx-2 mt-1 mb-1  pull-right">
                                <a href="employee.php" class="btn btn-fill btn-danger">
                                    <span class="fa fa-times"></span>
                                    <span>Abbrechen</span>
                                </a>
                                <button class="btn btn-fill btn-primary" name="ok">
                                    <span class="fa fa-save"></span>
                                    <span>Speichern</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
EOD;

include './layout/master.php';
?>
