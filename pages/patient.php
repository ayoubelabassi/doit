<?php
require_once __DIR__ . "/../domain/Patient.php";
if (isset($_GET["id"])) {
    Patient::delete($_GET["id"]);
    header("Location:patient.php");
}
$title = 'Patientenliste';
$nav = "patient";

$lines = "<tr>";
$patients = Patient::findAll();
foreach ($patients as $patient) {
    $id = $patient->id;
    $lines .= "<tr>
                <td>$patient->id</td>
                <td>$patient->firstName</td>
                <td>$patient->lastName</td>
                <td>$patient->phone</td>
                <td>$patient->city</td>
                <td>$patient->insuranceNumber</td>
                <td>$patient->insuranceType</td>
                <td>
                    <div class='btn-group'>
                        <a href='majpatient.php?id=$patient->id'  class='btn btn-sm btn-primary btn-fill'>
                            <span class='fa fa-pencil'></span>
                        </a>
                        <button class='btn btn-sm btn-danger btn-fill' data-toggle='modal' data-target='#patientModal' onclick='deletePatient($id)'>
                        <span class='fa fa-times'></span>
                        </button>
                    </div>
                </td>
            </tr>
            ";
}

$content = <<<EOD
    <script> 
        function deletePatient(id) {
            var deleteBtn=document.getElementById("btnDelete");
            deleteBtn.setAttribute("href", "patient.php?id="+id);
        }
    </script>
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <div class="d-inline-block">
                    <h4 class="title">Patientenliste</h4>
                </div>
                <div class="d-inline-block pull-right">
                    <a href="majpatient.php">
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
                        <th>Tél-Nr</th>
                        <th>Stadt</th>
                        <th>Versicherungsnummer</th>
                        <th>Versicherungsart</th>
                        <th>Aktionen</th>
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
<div class='modal fade' id='patientModal' tabindex='-1' role='dialog' aria-labelledby='patientModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>Patient löschen</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>
        Möchten Sie Wirklich diesen Patient löschen
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