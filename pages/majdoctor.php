<?php
require_once __DIR__ . "/../domain/Doctor.php";
$modals = "";
$doctor = new Doctor();
if (isset($_POST["ok"])) {
    $doctor->firstName = $_POST["firstName"];
    $doctor->lastName = $_POST["lastName"];
    $doctor->phone = $_POST["phone"];
    $doctor->email = $_POST["email"];
    $doctor->zip = $_POST["zip"];
    $doctor->city = $_POST["city"];
    $doctor->address = $_POST["address"];
    $doctor->login = $_POST["login"];
    $doctor->password = $_POST["password"];
    $doctor->speciality = $_POST["speciality"];
    if (isset($_GET["id"])) {
        $doctor->id = $_GET["id"];
    }
    $doctor->save();
    header("Location:doctor.php");
} else {
    if (isset($_GET["id"])) {
        $doctor = Doctor::findOneById($_GET["id"]);
    }
}

$title = 'Médecins';
$nav = "doctor";
$content = <<<EOD
<form method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header"><?php echo "hello"; ?>
                    <h5>Ajouter ou modifier un Médecin</h5>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" name="lastName" required class="form-control" value="$doctor->lastName">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prénom</label>
                                <input type="text" name="firstName" required class="form-control" value="$doctor->firstName">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ville</label>
                                <input type="text" name="city" required class="form-control" value="$doctor->city">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Code postal</label>
                                <input type="number" name="zip" required class="form-control" value="$doctor->zip">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Adresse</label>
                                <textarea type="text" name="address" required class="form-control">$doctor->address</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>N° Téléphone</label>
                                <input type="tel" name="phone" required class="form-control" value="$doctor->phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" required class="form-control" value="$doctor->email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Spécialité</label>
                                <input type="text" name="speciality" required class="form-control" value="$doctor->speciality">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Login</label>
                                <input type="text" name="login" required class="form-control" value="$doctor->login">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input type="password" name="password" required class="form-control" value="$doctor->password">
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
