<?php
require_once __DIR__ . "/../domain/Appointment.php";
require_once __DIR__ . "/../domain/Doctor.php";
require_once __DIR__ . "/../domain/Patient.php";

/**
 * Handle Create and update and delete
 */
if (isset($_GET["action"]) && $_GET["action"] == 'save' && isset($_POST["ok"])) {
    $appointment = new Appointment();
    $appointment->status = $_POST["status"];
    $appointment->reason = $_POST["reason"];
    $appointment->startDate = $_POST["startDate"];
    $appointment->endDate = $_POST["endDate"];
    $appointment->doctor = $_POST["doctor"];
    $appointment->patient = $_POST["patient"];
    if ($_POST["id"]) {
        $appointment->id = $_POST["id"];
    }
    $appointment->save();
    header("Location:appointment.php");
}

if (isset($_GET["action"]) && $_GET["action"] == 'delete') {
    Appointment::delete($_GET["id"]);
    header("Location:appointment.php");
}

$title = 'Termin';
$nav = "appointment";
$appointments = Appointment::findAll();

/**
 * Build Doctor Options
 */
$doctors = Doctor::getAllDoctors();
$doctorItems = "<option value='null'></option>";
foreach ($doctors as $doctor) {
    $doctorItems .= "
    <option value='$doctor->id'>$doctor->firstName $doctor->lastName</option>
            ";
}
/**
 * Build Patient Options
 */
$patients = Patient::findAll();
$patientItems = "<option value='null'></option>";
foreach ($patients as $patient) {
    $patientItems .= "
    <option value='$patient->id'>$patient->firstName $patient->lastName</option>
            ";
}

$lines = "<tr>";
foreach ($appointments as $app) {
    $id = $app->id;
    $jsonObj = json_encode($app);
    $lines .= "<tr>
                <td>$app->reason</td>
                <td>$app->startDate</td>
                <td>$app->endDate</td>
                <td>$app->doctorName</td>
                <td>$app->patientName</td>";
    if ($app->status == "PENDING") {
        $lines .= "<td><span class='btn btn-sm btn-fill btn-primary'>Beantragt</span></td>";
    } elseif ($app->status == "REJECTED") {
        $lines .= "<td><span class='btn btn-sm btn-fill btn-danger'>Abgelehnt</span></td>";
    } elseif ($app->status == "CANCELED") {
        $lines .= "<td><span class='btn btn-sm btn-fill btn-warning'>Abgesagt</span></td>";
    } elseif ($app->status == "VALIDATED") {
        $lines .= "<td><span class='btn btn-sm btn-fill btn-success'>Bestätigt</span></td>";
    }
    $lines .= "
                <td>
                    <div class='btn-group'>
                        <button type='button'  class='btn btn-sm btn-primary btn-fill' data-toggle='modal' data-target='#appointmentModal' onclick='editAppointment($jsonObj)'>
                            <span class='fa fa-pencil'></span>
                        </button>
                        <button type='button' class='btn btn-sm btn-danger btn-fill' data-toggle='modal' data-target='#deleteAppointmentModal' onclick='deleteAppointment($id)'>
                        <span class='fa fa-times'></span>
                        </button>
                    </div>
                </td>
            </tr>
            ";
}

$content = <<<EOD
    <script> 
        function deleteAppointment(docId) {
            var deleteBtn=document.getElementById("btnDelete");
            deleteBtn.setAttribute("href", "appointment.php?action=delete&id="+docId);
        }
        function editAppointment(appointment) {
          jQuery('#id').val(appointment.id);
          jQuery('#startDate').val(appointment.startDate);
          jQuery('#endDate').val(appointment.endDate);
          jQuery('#status').val(appointment.status);
          jQuery('#reason').val(appointment.reason);
          jQuery('#patient').val(appointment.patient);
          jQuery('#doctor').val(appointment.doctor);
        }
    </script>
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <div class="d-inline-block">
                    <h4 class="title">Termin</h4>
                </div>
                <div class="d-inline-block pull-right">
                    <div>
                        <button class="btn btn-fill btn-primary" data-toggle='modal' data-target='#appointmentModal'>
                            <span class="fa fa-plus"></span>
                            <span>Hinzufügen</span>
                        </button>
                        <a href="../actions/sendemail.php">
                            <button class="btn btn-fill btn-info">
                                <span class="fa fa-envelope-o"></span>
                                <span>Patiënten informeren</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Grund</th>
                        <th>terminbeginn</th>
                        <th>Terminende</th>
                        <th>Arzt</th>
                        <th>Patient</th>
                        <th>Status</th>
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
<div class='modal fade' id='deleteAppointmentModal' tabindex='-1' role='dialog' aria-labelledby='doctorModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>Termin löschen</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>
        Möchten Sie diesen Termin löschen ?
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        <a href='' id='btnDelete' type='button' class='btn btn-danger'>Löschen</a>
      </div>
    </div>
  </div>
</div>

<div class='modal fade' id='appointmentModal' tabindex='-1' role='dialog' aria-labelledby='appointmentModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-lg' role='document'>
  <form method="post" action="appointment.php?action=save">
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>termin hinzufügen oder ändern</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>
        <div class="row">
    <input hidden name="id" id="id">
    <div class="col-md-6">
        <div class="form-group">
            <label>Patient</label>
            <select class="form-control" required name="patient" id="patient">$patientItems</select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Arzt</label>
            <select class="form-control" required name="doctor" id="doctor">$doctorItems</select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Terminbeginn</label>
            <input id="startDate" required name="startDate" class="form-control" type="text">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Terminende</label>
            <input id="endDate" required name="endDate" class="form-control" type="text">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Status</label>
            <select name="status" required id="status" class="form-control">
                <option value="null"></option>
                <option value="PENDING">Beantragt</option>
                <option value="VALIDATED">Bestätigt</option>
                <option value="REJECTED">Abgelehnt</option>
                <option value="CANCELED">Abgesagt</option>
                <option value="CLOSED">Abgeshloßen</option>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Grund</label>
            <textarea id="reason" name="reason" class="form-control"></textarea>
        </div>
    </div>
</div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-fill btn-secondary' data-dismiss='modal'>Schließen</button>
        <button name="ok" id='btnSave' type='submit' class='btn btn-fill btn-success'>Speichern</button>
      </div>
    </div>
  </form>
  </div>
</div>
<script>
    jQuery('#startDate').datetimepicker({
  format:'Y-m-d H:i',
  lang:'en'
});
    jQuery('#endDate').datetimepicker({
  format:'Y-m-d H:i',
  lang:'en'
});
</script>
EOD;
include './layout/master.php';

?>
