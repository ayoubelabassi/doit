<?php
session_start();
require_once __DIR__ . "/../utils/DbUtils.php";
$dbUtils = new DbUtils();

if (!isset($_GET['start']) || !isset($_GET['end'])) {
    die("Please provide a date range.");
}

if (!isset($_SESSION["user_id"])) {
    die("Please login first.");
}

$range_start = $_GET['start'] . " 00:00:00";
$range_end = $_GET['end'] . " 23:59:59";
$patientId = $_SESSION['user_id'];

$query = "SELECT a.id, a.start_date AS start, a.end_date AS end,
	IF(a.status='PENDING', '#17a2b8', IF(a.status='VALIDATED', '#28a745', IF(a.status='CANCELED','#eb8b1c','#eb4040'))) AS backgroundColor,
  a.reason AS title 
  FROM appointment AS a 
  LEFT JOIN patient AS p ON p.id=a.patient_id 
  LEFT JOIN doctor AS d ON d.id= a.doctor_id where a.start_date between '$range_start' and '$range_end' and patient_id=$patientId";

$stmt = $dbUtils->executeQuery($query);
$rows = array();
while ($row = $stmt->fetch()) {
    $rows[] = $row;
}
echo json_encode($rows);
?>