<?php
require_once __DIR__ . "/../domain/Employee.php";
/*
if (!isset($_GET["action"])) {
} else {
    $action = $_GET["action"];
}
*/
$title = 'Employées';
$nav = "employee";
$content = '<div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">List des employés</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Tél</th>
                                        <th>Ville</th>
                                        <th>Spécialité</th>
                                        <th>Login</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>';
$employees = Employee::findAllEmployees();
foreach ($employees as $emp) {
$content .= "<tr>
                <td>" . $emp->getId() . "</td>
                <td>" . $emp->getFirstName() . "</td>
                <td>" . $emp->getLastName() . "</td>
                <td>" . $emp->getPhone() . "</td>
                <td>" . $emp->getCity() . "</td>
                <td>" . $emp->getSpeciality() . "</td>
                <td>" . $emp->getLogin() . "</td>
                <td>" . $emp->getRole() . "</td>
                <td>
                    <div class='btn-group'>
                        <button class='btn btn-primary btn-fill'><span class='fa fa-pencil'></span></button>
                        <button class='btn btn-danger btn-fill'><span class='fa fa-times'></span></button>
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
</div>";

include './layout/master.php';
?>