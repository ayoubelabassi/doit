<?php
require_once "Mail.php";
require_once "Mail/mime.php";
require_once __DIR__ . "/../utils/DbUtils.php";

function sendEmail($email, $date, $hour, $patient, $doctor, $left)
{
    $from = "no-reply@app-tracker.tk";
    $host = "smtp.hostinger.com";
    $username = "no-reply@app-tracker.tk";
    $password = "doit2020";
    $port = "587";
    $headers = array(
        'From' => $from,
        'To' => $email,
        'Subject' => "Erinnerung an Ihrem Termin"
    );

    $body = <<<EOD
<!DOCTYPE HTML>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<div style="width: 500px;border: 1px solid #3498DB;margin: 0rem auto;">
    <div style="text-align: center; background-color: #3498DB; color: white; padding: 1rem;">
    <br/>
        <div style="font-size: 1.3rem;">Liebe(r) $patient, <br>
           Ihr Termin bei Praxis Dr.$doctor ist in $left tage(n) f&#228;llig.  </div><br/>
    </div>
    <div style="text-align: center">
        <h4>Termin mit Dr. $doctor</h4>
        <h4>am $date um $hour</h4>
    </div>
    <div></div>
</div>
</body>
</html>
EOD;
    $mime = new Mail_mime('');

    $mime->setTXTBody('');
    $mime->setHTMLBody($body);

    $body = $mime->get();
    $headers = $mime->headers($headers);

    $smtp = Mail::factory('smtp', array(
        'host' => $host,
        'port' => $port,
        'auth' => true,
        'username' => $username,
        'password' => $password,
        'Content-type' => 'text/html;charset=utf-8'
    ));
    $mail = $smtp->send($email, $headers, $body);

    if (PEAR::isError($mail)) {
        echo "Email Error";
    } else {
        echo "Email send succes";
    }
}

function notifyPatientsAppointments()
{
    $dbUtils = new DbUtils();
    $query = "SELECT a.id,
		DATE_FORMAT(a.start_date,'%d.%m.%Y') AS 'date',
		DATE_FORMAT(a.start_date,'%H:%i') AS 'hour',
		CONCAT(p.first_name,' ',p.last_name) AS 'patient',
		CONCAT(d.first_name,' ',d.last_name) AS 'doctor',
		DATEDIFF(a.start_date, NOW()) AS 'left',
		p.email,
  		a.reason
      FROM appointment AS a 
  LEFT JOIN patient AS p ON p.id=a.patient_id 
  LEFT JOIN doctor AS d ON d.id= a.doctor_id 
  where DATEDIFF(a.start_date, NOW()) BETWEEN 1 AND 2 AND a.status LIKE 'VALIDATED';";
    $stmt = $dbUtils->executeQuery($query);
    while ($row = $stmt->fetch()) {
        $date = $row["date"];
        $hour = $row["hour"];
        $patient = $row["patient"];
        $doctor = $row["doctor"];
        $left = $row["left"];
        $email = $row["email"];
        sendEmail($email, $date, $hour, $patient, $doctor, $left);
    }
}

notifyPatientsAppointments();
header("Location:../pages/appointment.php");
?>