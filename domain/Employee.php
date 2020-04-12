<?php

require_once __DIR__ . "/../utils/DbUtils.php";

class Employee
{
    public $id;

    public $firstName;

    public $lastName;

    public $address;

    public $city;

    public $zip;

    public $email;

    public $phone;

    public $login;

    public $password;

    public $doctor;

    /**
     * Find All Employees
     */

    public static function findAllEmployees()
    {
        $dbUtils = new DbUtils();
        $query = "select * from employee;";
        $stmt = $dbUtils->executeQuery($query);
        $employees = [];
        while ($row = $stmt->fetch()) {
            $employee = new Employee();
            $employee->id = $row["id"];
            $employee->firstName = $row["first_name"];
            $employee->lastName = $row["last_name"];
            $employee->email = $row["email"];
            $employee->phone = $row["phone"];
            $employee->password = $row["password"];
            $employee->city = $row["city"];
            $employee->login = $row["login"];
            $employee->address = $row["address"];
            $employee->zip = $row["zip"];
            $employee->doctor = $row["doctor_fk"];
            $employees[] = $employee;
        }
        return $employees;
    }

    public static function findOneById($id)
    {
        $dbUtils = new DbUtils();
        $query = "select * from employee where id=$id;";
        $stmt = $dbUtils->executeQuery($query);
        $employee = new Employee();
        while ($row = $stmt->fetch()) {
            $employee->id = $row["id"];
            $employee->firstName = $row["first_name"];
            $employee->lastName = $row["last_name"];
            $employee->email = $row["email"];
            $employee->phone = $row["phone"];
            $employee->password = $row["password"];
            $employee->city = $row["city"];
            $employee->login = $row["login"];
            $employee->address = $row["address"];
            $employee->zip = $row["zip"];
            $employee->doctor = $row["doctor_fk"];
        }
        return $employee;
    }

    public static function findOneByLoginAndPassword($login, $password)
    {
        $dbUtils = new DbUtils();
        $query = "select * from employee where login='$login' and password='$password';";
        $stmt = $dbUtils->executeQuery($query);
        $employee = new Employee();
        while ($row = $stmt->fetch()) {
            $employee->id = $row["id"];
            $employee->firstName = $row["first_name"];
            $employee->lastName = $row["last_name"];
            $employee->email = $row["email"];
            $employee->phone = $row["phone"];
            $employee->password = $row["password"];
            $employee->city = $row["city"];
            $employee->login = $row["login"];
            $employee->address = $row["address"];
            $employee->zip = $row["zip"];
            $employee->doctor = $row["doctor_fk"];
        }
        return $employee;
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
            $this->doctor);
        if (empty($this->id) || $this->id == null) {
            $query = "insert into employee(first_name, last_name, city, zip, address, email, phone, login, password, doctor_fk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        } else {
            $query = "update employee set first_name=?,
                                          last_name=?,
                                          city=?,
                                          zip=?,
                                          address=?,
                                          email=?,
                                          phone=?,
                                          login=?,
                                          password=?,
                                          doctor_fk=? where id=?";
            array_push($params, $this->id);
        }
        $dbUtils = new DbUtils();
        $res = $dbUtils->executeUpdate($query, $params);
        return $res;
    }

    public static function delete($id)
    {
        $query = "delete employee from employee where id=$id;";
        $dbUtils = new DbUtils();
        $res = $dbUtils->executeUpdate($query, []);
        return $res;
    }
}

?>