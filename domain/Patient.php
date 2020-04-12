<?php
require_once __DIR__ . "/../utils/DbUtils.php";

class Patient
{
    public $id;
    public $firstName;
    public $lastName;
    public $address;
    public $city;
    public $zip;
    public $email;
    public $phone;
    public $birthday;
    public $insuranceNumber;
    public $insuranceType;

    public static function findAll()
    {
        $dbUtils = new DbUtils();
        $query = "select * from patient;";
        $stmt = $dbUtils->executeQuery($query);
        $patients = [];
        while ($row = $stmt->fetch()) {
            $patient = new Patient();
            $patient->id = $row["id"];
            $patient->firstName = $row["first_name"];
            $patient->lastName = $row["last_name"];
            $patient->email = $row["email"];
            $patient->phone = $row["phone"];
            $patient->birthday = $row["birthday"];
            $patient->city = $row["city"];
            $patient->insuranceNumber = $row["ensurrence_number"];
            $patient->address = $row["address"];
            $patient->insuranceType = $row["ensurence_type"];
            $patient->zip = $row["zip"];
            $patients[] = $patient;
        }
        return $patients;
    }

    public static function findOneById($id)
    {
        $dbUtils = new DbUtils();
        $query = "select * from patient where id=$id;";
        $stmt = $dbUtils->executeQuery($query);
        $patient = new Patient();
        while ($row = $stmt->fetch()) {
            $patient->id = $row["id"];
            $patient->firstName = $row["first_name"];
            $patient->lastName = $row["last_name"];
            $patient->email = $row["email"];
            $patient->phone = $row["phone"];
            $patient->birthday = $row["birthday"];
            $patient->city = $row["city"];
            $patient->insuranceNumber = $row["ensurrence_number"];
            $patient->address = $row["address"];
            $patient->insuranceType = $row["ensurence_type"];
            $patient->zip = $row["zip"];
        }
        return $patient;
    }


    public static function findOneByInsuranceAndBirthDay($number, $birthday)
    {
        $dbUtils = new DbUtils();
        $query = "select * from patient where ensurrence_number='$number' and birthday='$birthday';";
        $stmt = $dbUtils->executeQuery($query);
        $patient = new Patient();
        while ($row = $stmt->fetch()) {
            $patient->id = $row["id"];
            $patient->firstName = $row["first_name"];
            $patient->lastName = $row["last_name"];
            $patient->email = $row["email"];
            $patient->phone = $row["phone"];
            $patient->birthday = $row["birthday"];
            $patient->city = $row["city"];
            $patient->insuranceNumber = $row["ensurrence_number"];
            $patient->address = $row["address"];
            $patient->insuranceType = $row["ensurence_type"];
            $patient->zip = $row["zip"];
        }
        return $patient;
    }

    public function save()
    {
        $query = "";
        $params = array($this->firstName, $this->lastName, $this->email,
            $this->phone, $this->insuranceNumber, $this->city, $this->address, $this->zip, $this->birthday, $this->insuranceType);
        if (empty($this->id) || $this->id == null) {
            $query = "insert into patient (first_name, last_name, email, phone, ensurrence_number, city, address, zip, birthday, ensurence_type) VALUES (?,?,?,?,?,?,?,?,?,?);";
        } else {
            $query = "update patient set first_name=?,
                                          last_name=?,
                                          email=?,
                                          phone=?,
                                          ensurrence_number=?,
                                          city=?,
                                          address=?,
                                          zip=?,
                                          birthday=?,
                                          ensurence_type=? where id=?";
            array_push($params, $this->id);
        }
        $dbUtils = new DbUtils();
        $res = $dbUtils->executeUpdate($query, $params);
        return $res;
    }

    public function delete($id)
    {
        $query = "delete patient from patient where id=$id;";
        $dbUtils = new DbUtils();
        $res = $dbUtils->executeUpdate($query, []);
        return $res;
    }
}