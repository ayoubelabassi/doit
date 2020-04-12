<?php

require_once __DIR__ . "/../utils/DbUtils.php";

class Doctor
{
    public $id;
    public $firstName;
    public $lastName;
    public $address;
    public $speciality;
    public $city;
    public $zip;
    public $phone;
    public $email;
    public $login;
    public $password;

    public static function getAllDoctors()
    {
        $dbUtils = new DbUtils();
        $query = "select * from doctor;";
        $stmt = $dbUtils->executeQuery($query);
        $doctors = [];
        while ($row = $stmt->fetch()) {
            $doctor = new Doctor();
            $doctor->id = $row["id"];
            $doctor->firstName = $row["first_name"];
            $doctor->lastName = $row["last_name"];
            $doctor->email = $row["email"];
            $doctor->phone = $row["phone"];
            $doctor->password = $row["password"];
            $doctor->city = $row["city"];
            $doctor->login = $row["login"];
            $doctor->address = $row["address"];
            $doctor->speciality = $row["speciality"];
            $doctor->zip = $row["zip"];
            $doctors[] = $doctor;
        }
        return $doctors;
    }

    public function save()
    {
        $query = "";
        $params = array($this->firstName,
            $this->lastName,
            $this->city,
            $this->zip,
            $this->address,
            $this->email,
            $this->phone,
            $this->login,
            $this->password,
            $this->speciality);
        if (empty($this->id) || $this->id == null) {
            $query = "insert into doctor(first_name, last_name, city, zip, address, email, phone, login, password, speciality) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        } else {
            $query = "update doctor set first_name=?,
                                          last_name=?,
                                          city=?,
                                          zip=?,
                                          address=?,
                                          email=?,
                                          phone=?,
                                          login=?,
                                          password=?,
                                          speciality=? where id=?";
            array_push($params, $this->id);
        }
        $dbUtils = new DbUtils();
        $res = $dbUtils->executeUpdate($query, $params);
        return $res;
    }

    public static function findOneById($id)
    {
        $dbUtils = new DbUtils();
        $query = "select * from doctor where id=$id;";
        $stmt = $dbUtils->executeQuery($query);
        $doctor = new Doctor();
        while ($row = $stmt->fetch()) {
            $doctor->id = $row["id"];
            $doctor->firstName = $row["first_name"];
            $doctor->lastName = $row["last_name"];
            $doctor->email = $row["email"];
            $doctor->phone = $row["phone"];
            $doctor->password = $row["password"];
            $doctor->city = $row["city"];
            $doctor->login = $row["login"];
            $doctor->address = $row["address"];
            $doctor->speciality = $row["speciality"];
            $doctor->zip = $row["zip"];
        }
        return $doctor;
    }
    public static function findOneByLoginAndPassword($login, $password)
    {
        $dbUtils = new DbUtils();
        $query = "select * from doctor where login='$login' and password='$password'";
        $stmt = $dbUtils->executeQuery($query);
        $doctor = new Doctor();
        while ($row = $stmt->fetch()) {
            $doctor->id = $row["id"];
            $doctor->firstName = $row["first_name"];
            $doctor->lastName = $row["last_name"];
            $doctor->email = $row["email"];
            $doctor->phone = $row["phone"];
            $doctor->password = $row["password"];
            $doctor->city = $row["city"];
            $doctor->login = $row["login"];
            $doctor->address = $row["address"];
            $doctor->speciality = $row["speciality"];
            $doctor->zip = $row["zip"];
        }
        return $doctor;
    }

    public static function delete($id)
    {
        $query = "delete doctor from doctor where id=$id;";
        $dbUtils = new DbUtils();
        $res = $dbUtils->executeUpdate($query, []);
        return $res;
    }
}


?>