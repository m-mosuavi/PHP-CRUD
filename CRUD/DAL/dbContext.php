<?php

class dbContext
{
    function GetCs()
    {
        $DB_HOST = 'localhost';
        $DB_USER = 'root';
        $DB_PASS = '';
        $DB_NAME = 'crud';

        try {
            $conn = new PDO('mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
            $conn->exec('SET NAMES utf8');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
    public function GetById($id)
    {
        $conn = $this->GetCs();
        try {
            $stmt = $conn->prepare("CALL GetById(?)");
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $data = $stmt->fetch();
            return $data;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $conn = null;
    }


    public function GetAll()
    {
        $conn = $this->GetCs();
        try {
            $stmt = $conn->query("CALL GetALL()");
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt->nextRowset();
            return $data;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $conn = null;
    }

    public function Delete($id)
    {
        $conn = $this->GetCs();
        try {
            $stmt = $conn->prepare("CALL DelById(?)");
            $stmt->bindParam(1, $id);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $conn = null;
    }

    public function Update($userId, $fname, $lname, $email, $address, $phone)
    {
        $conn = $this->GetCs();
        try {
            $stmt = $conn->prepare("CALL UpdateById(?,?,?,?,?,?)");
            $stmt->bindParam(1, $userId);
            $stmt->bindParam(2, $fname);
            $stmt->bindParam(3, $lname);
            $stmt->bindParam(4, $email);
            $stmt->bindParam(5, $address);
            $stmt->bindParam(6, $phone);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $conn = null;
    }

    public function Insert($fname, $lname, $email, $address, $phone)
    {
        // $conn=$this->GetCs();
        // try {
        //     $stmt = $conn->prepare("CALL Insert(?,?,?,?,?)");

        //     $stmt->bindParam(1,$fname,PDO::PARAM_STR);
        //     $stmt->bindParam(2,$lname,PDO::PARAM_STR);
        //     $stmt->bindParam(3,$email,PDO::PARAM_STR);
        //     $stmt->bindParam(4,$address,PDO::PARAM_STR);
        //     $stmt->bindParam(5,$phone,PDO::PARAM_INT);
        //     $stmt->execute();
        //     var_dump($stmt);
        //     exit;
        //     return $conn->lastInsertId();
        // } catch (Exception $e) {
        //     echo $e->getMessage();
        // }
        // $conn=null;
        $conn = $this->GetCs();

        $sql = "INSERT INTO users(firstName,lastName,email,address,phone) VALUES(:firstname,:lastname,:email,:address,:phone)";

        $query = $conn->prepare($sql);
        $query->bindParam(':firstname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lastname', $lname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query->execute();
        return $conn->lastInsertId();
        $conn = null;
    }
}
