<?php
require_once __DIR__ . "/../domain/Doctor.php";
if (isset($_GET["id"])) {
    Doctor::delete($_GET["id"]);
    header("Location:doctor.php");
}
$title = 'Ärtzeliste';
$nav = "doctor";
$lines = "<tr>";
$doctors = Doctor::getAllDoctors();
foreach ($doctors as $doctor) {
    $id = $doctor->id;
    $lines .= "<tr>
                <td>$doctor->id</td>
                <td>$doctor->firstName</td>
                <td>$doctor->lastName</td>
                <td>$doctor->phone</td>
                <td>$doctor->city</td>
                <td>$doctor->login</td>
                <td>$doctor->speciality</td>
                <td>
                    <div class='btn-group'>
                        <a href='majdoctor.php?id=$doctor->id'  class='btn btn-sm btn-primary btn-fill'>
                            <span class='fa fa-pencil'></span>
                        </a>
                        <button class='btn btn-sm btn-danger btn-fill' data-toggle='modal' data-target='#doctorModal' onclick='deleteDoctor($id)'>
                        <span class='fa fa-times'></span>
                        </button>
                    </div>
                </td>
            </tr>
            ";
}

$content = <<<EOD
    <script> 
        function deleteDoctor(docId) {
            var deleteBtn=document.getElementById("btnDelete");
            deleteBtn.setAttribute("href", "doctor.php?id="+docId);
        }
    </script>
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <div class="d-inline-block">
                    <h4 class="title">Ärzteliste</h4>
                </div>
                <div class="d-inline-block pull-right">
                    <a href="majdoctor.php">
                        <button class="btn btn-fill btn-primary">
                            <span class="fa fa-plus"></span>
                            <span>Hinzufügen</span>
                        </button>
                    </a>
                </div>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nachname</th>
                        <th>Vorname</th>
                        <th>Tél</th>
                        <th>Stadt</th>
                        <th>Login</th>
                        <th>Facgbereich</th>
                        <th>AKtionen</th>
                    </tr>
                    </thead>
                    <tbody>
                        $lines
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
EOD;

$modals = <<<EOD
<div class='modal fade' id='doctorModal' tabindex='-1' role='dialog' aria-labelledby='doctorModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>Arzt löschen</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>
        Möchten Sie wirklich diesen Arzt löschen? 
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Schließen</button>
        <a href='' id='btnDelete' type='button' class='btn btn-danger'>Löschen</a>
      </div>
    </div>
  </div>
</div>
EOD;

include './layout/master.php';
?>