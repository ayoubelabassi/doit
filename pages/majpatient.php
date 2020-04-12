<?php
require_once __DIR__ . "/../domain/Patient.php";
$modals = "";
$patient = new Patient();
if (isset($_POST["ok"])) {
    $patient->firstName = $_POST["firstName"];
    $patient->lastName = $_POST["lastName"];
    $patient->phone = $_POST["phone"];
    $patient->email = $_POST["email"];
    $patient->zip = $_POST["zip"];
    $patient->city = $_POST["city"];
    $patient->address = $_POST["address"];
    $patient->birthday = $_POST["birthday"];
    $patient->insuranceNumber = $_POST["insuranceNumber"];
    $patient->insuranceType = $_POST["insuranceType"];
    if (isset($_GET["id"])) {
        $patient->id = $_GET["id"];
    }
    $patient->save();
    header("Location:patient.php");
} else {
    if (isset($_GET["id"])) {
        $patient = Patient::findOneById($_GET["id"]);
    }
}

$title = 'Patients';
$nav = "patient";
$content = <<<EOD
<form method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header"><?php echo "hello"; ?>
                    <h5>Ajouter ou modifier un Patient</h5>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" name="lastName" required class="form-control" value="$patient->lastName">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prénom</label>
                                <input type="text" name="firstName" required class="form-control" value="$patient->firstName">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ville</label>
                                <input type="text" name="city" required class="form-control" value="$patient->city">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Code postal</label>
                                <input type="number" name="zip" required class="form-control" value="$patient->zip">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Adresse</label>
                                <textarea type="text" name="address" required class="form-control">$patient->address</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>N° Téléphone</label>
                                <input type="tel" name="phone" required class="form-control" value="$patient->phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" required class="form-control" value="$patient->email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date naissance</label>
                                <input type="date" name="birthday" required class="form-control" value="$patient->birthday">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Type assurance</label>
                                <input type="text" name="insuranceType" max="10" maxlength="10" required class="form-control" value="$patient->insuranceType">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Numéro assurance</label>
                                <input type="text" name="insuranceNumber" maxlength="50" required class="form-control" value="$patient->insuranceNumber">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group mx-2 mt-1 mb-1  pull-right">
                                <button class="btn btn-fill btn-primary" name="ok">
                                    <span class="fa fa-save"></span>
                                    <span>Sauvegarder</span>
                                </button>
                                <button type="button" class="btn btn-fill btn-danger">
                                    <a href="doctor.php" class=" color-white">
                                        <span class="fa fa-times"></span>
                                        <span>Annuler</span>
                                    </a>
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
