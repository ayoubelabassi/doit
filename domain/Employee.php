<?php

require_once __DIR__ . "/../utils/DbUtils.php";

class Employee
{
    private $id;

    private $firstName;

    private $lastName;

    private $address;

    private $city;

    private $zip;

    private $email;

    private $phone;

    private $login;

    private $password;

    private $role;

    private $speciality;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }

    /**
     * @param mixed $speciality
     */
    public function setSpeciality($speciality)
    {
        $this->speciality = $speciality;
    }

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
            $employee->setId($row["id"]);
            $employee->setFirstName($row["first_name"]);
            $employee->setLastName($row["last_name"]);
            $employee->setEmail($row["email"]);
            $employee->setPhone($row["phone"]);
            $employee->setPassword($row["password"]);
            $employee->setCity($row["city"]);
            $employee->setLogin($row["login"]);
            $employee->setAddress($row["address"]);
            $employee->setZip($row["zip"]);
            $employee->setRole($row["role"]);
            $employee->setSpeciality($row["speciality"]);
            $employees[] = $employee;
        }
        return $employees;
    }

    public function save()
    {
        $query = "";
        $params = array($this->firstName, $this->lastName, $this->email,
            $this->phone, $this->password, $this->city, $this->login, $this->address, $this->zip, $this->role, $this->speciality);
        if (empty($this->id) || $this->id == null) {
            $query = "insert into employee (first_name, last_name, email, phone, password, city, login, address, zip, role, speciality) VALUES (?,?,?,?,?,?,?,?,?,?,?);";
        } else {
            $query = "update employee set first_name=?,
                                          last_name=?,
                                          email=?,
                                          phone=?,
                                          password=?,
                                          city=?,
                                          login=?,
                                          address=?,
                                          zip=?,
                                          role=?,
                                          speciality=? where id=?";
            array_push($params, $this->id);
        }
        $dbUtils = new DbUtils();
        $res = $dbUtils->executeUpdate($query, $params);
        return $res;
    }
}

?>