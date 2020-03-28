<?php
/**
 * Created by PhpStorm.
 * User: AYOUB
 * Date: 25/03/2020
 * Time: 19:05
 */

require_once __DIR__ . "/../domain/Employee.php";

if (!isset($_GET["action"])) {
    return;
}
$action = $_GET["action"];

if ($action == "find-all") {
    $employees = Employee::findAllEmployees();
    echo "
    <table>
    <thead>
        <tr>
            <th>#ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Tél</th>
            <th>Ville</th>
            <th>Adresse</th>
            <th>ZIP</th>
            <th>Spécialité</th>
            <th>Login</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead><tbody>";
    foreach ($employees as $emp) {
        echo "
                <tr>
                    <td>" . $emp->getId() . "</td>
                    <td>" . $emp->getFirstName() . "</td>
                    <td>" . $emp->getLastName() . "</td>
                    <td>" . $emp->getEmail() . "</td>
                    <td>" . $emp->getPhone() . "</td>
                    <td>" . $emp->getCity() . "</td>
                    <td>" . $emp->getAddress() . "</td>
                    <td>" . $emp->getZip() . "</td>
                    <td>" . $emp->getSpeciality() . "</td>
                    <td>" . $emp->getLogin() . "</td>
                    <td>" . $emp->getRole() . "</td>
                    <td></td>
                </tr>
                ";
    }
    echo "<tbody></table>";
} elseif ($action == "create") {
    $employee = new Employee();
    $employee->setFirstName("SLAH");
    $employee->setLastName("EL ABASSI");
    $employee->setEmail("salahelabassi0@gmail.com");
    $employee->setPhone("+212610507786");
    $employee->setPassword("salah1992");
    $employee->setCity("Casablanca");
    $employee->setLogin("ayoubelabassi");
    $employee->setAddress("ANASSI SIDI BERNOUSSI");
    $employee->setZip("20050");
    $employee->setRole("Infermier");
    $employee->setSpeciality("Réanimation");
    $res = $employee->save();
    echo "Resultat create $res";

} elseif ($action == "update") {
    $employee = new Employee();
    $employee->setId(1);
    $employee->setFirstName("AYOUB");
    $employee->setLastName("EL ABASSI");
    $employee->setEmail("ayoubelabassi0@gmail.com");
    $employee->setPhone("+212611060897");
    $employee->setPassword("ayoub");
    $employee->setCity("Beni Mellal");
    $employee->setLogin("ayoubelabassi");
    $employee->setAddress("Zenkat Azemour EL MDINA KDIMA");
    $employee->setZip("23400");
    $employee->setRole("Medecin");
    $employee->setSpeciality("Dentiste");
    $res = $employee->save();
    echo "Resultat Update $res";
}