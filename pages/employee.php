<?php
require_once __DIR__ . "/../domain/Employee.php";
$modals = "";
if (isset($_GET["id"])) {
    Employee::delete($_GET["id"]);
    header("Location:employee.php");
}
$title = 'Angestellter';
$nav = "employee";
$content = '<div class="row">
                    <script> 
                        function deleteEmploye(employeId) {
                            var deleteBtn=document.getElementById("btnDelete");
                            deleteBtn.setAttribute("href", "employee.php?id="+employeId);
                        }
                    </script>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <div class="d-inline-block">
                                    <h4 class="title">Angestellteliste</h4>
                                </div>
                                <div class="d-inline-block pull-right">
                                    <a href="majemployee.php">
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
                                        <th>AKtionen</th>
                                    </tr>
                                    </thead>
                                    <tbody>';
$employees = Employee::findAllEmployees();
foreach ($employees as $emp) {
    $content .= "<tr>
                <td>$emp->id</td>
                <td>$emp->firstName</td>
                <td>$emp->lastName</td>
                <td>$emp->phone</td>
                <td>$emp->city</td>
                <td>$emp->login</td>
                <td>
                    <div class='btn-group'>
                        <a href='majemployee.php?id=$emp->id'  class='btn btn-sm btn-primary btn-fill'>
                            <span class='fa fa-pencil'></span>
                        </a>
                        <button class='btn btn-sm btn-danger btn-fill' data-toggle=\"modal\" data-target='#exampleModal' onclick='deleteEmploye($emp->id)'>
                        <span class='fa fa-times'></span>
                        </button>
                    </div>
                </td>
            </tr>
            ";
}
$content .= "
</tbody>
</table>

</div>
</div>
</div>
</div>
";
$modals = <<<EOD
<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>Angestellter Löschen</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>
         Möchten Sie wirklich diser Angestelter löschen
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

