<?php
/**
 * Created by PhpStorm.
 * User: AYOUB
 * Date: 11/03/2020
 * Time: 19:51
 */

require_once __DIR__ . "/../utils/DbUtils.php";
class Appointment
{
    public $id;
    public $startDate;
    public $endDate;
    public $reason;
    public $status;
    public $doctor;
    public $patient;

    public $patientName;
    public $doctorName;

    public static function findAll()
    {
        $dbUtils = new DbUtils();
        $query = "select a.*,
                    CONCAT(p.first_name, ' ', p.last_name) as 'patient_name',
                    CONCAT(d.first_name, ' ', d.last_name) as 'doctor_name' 
                    from appointment as a 
                    join patient as p on p.id=a.patient_id
                    join doctor as d on d.id=a.doctor_id;";
        $stmt = $dbUtils->executeQuery($query);
        $appointments = [];
        while ($row = $stmt->fetch()) {
            $appointment = new Appointment();
            $appointment->id = $row["id"];
            $appointment->startDate = $row["start_date"];
            $appointment->endDate = $row["end_date"];
            $appointment->status = $row["status"];
            $appointment->patient = $row["patient_id"];
            $appointment->doctor = $row["doctor_id"];
            $appointment->reason = $row["reason"];
            $appointment->patientName = $row["patient_name"];
            $appointment->doctorName = $row["doctor_name"];
            $appointments[] = $appointment;
        }
        return $appointments;
    }

    public function save()
    {
        $query = "";
        $params = array($this->reason,
            $this->startDate,
            $this->endDate,
            $this->status,
            $this->patient,
            $this->doctor);
        if (empty($this->id) || $this->id == null) {
            $query = "insert into appointment(reason, start_date, end_date, status, patient_id, doctor_id) VALUES (?, ?, ?, ?, ?, ?);";
        } else {
            $query = "update appointment set reason=?,
                                          start_date=?,
                                          end_date=?,
                                          status=?,
                                          patient_id=?,
                                          doctor_id=? where id=?";
            array_push($params, $this->id);
        }
        $dbUtils = new DbUtils();
        $res = $dbUtils->executeUpdate($query, $params);
        return $res;
    }

    public static function updateStatus($id, $status)
    {
        $params = array($status, $id);
        $query = "update appointment set status=? where id=?";
        $dbUtils = new DbUtils();
        $res = $dbUtils->executeUpdate($query, $params);
        return $res;
    }

    public static function delete($id)
    {
        $query = "delete appointment from appointment where id=$id;";
        $dbUtils = new DbUtils();
        $res = $dbUtils->executeUpdate($query, []);
        return $res;
    }
}