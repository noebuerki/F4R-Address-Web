<?php

namespace App\Repository;

use App\DataBase\ConnectionHandler;
use Exception;

require_once '../src/DataBase/ConnectionHandler.php';

class SupplierRepository extends Repository
{
    protected $tablename = "supplier";
    private $columnUserId = "userId";
    private $columnCompany = "company";
    private $columnFirstName = "firstName";
    private $columnLastName = "lastName";
    private $columnStreet = "street";
    private $columnHouseNumber = "houseNumber";
    private $columnZIP = "zip";
    private $columnCity = "city";

    /* Database-Statements */
    public function readByID($userId, $id)
    {
        $query = "SELECT * FROM $this->tablename WHERE $this->columnUserId = ? AND $this->columnId = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $userId, $id);
        $statement->execute();

        return $this->processSingleResult($statement->get_result());
    }

    public function deleteById($userId, $id)
    {
        $query = "DELETE FROM $this->tablename WHERE $this->columnUserId = ? AND $this->columnId = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $userId, $id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function create($userId, $company, $firstName, $lastName, $street, $houseNumber, $zip, $city)
    {
        $query = "INSERT INTO $this->tablename ($this->columnUserId, $this->columnCompany, $this->columnFirstName, $this->columnLastName, $this->columnStreet, $this->columnHouseNumber, $this->columnZIP, $this->columnCity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('isssssss', $userId, $company, $firstName, $lastName, $street, $houseNumber, $zip, $city);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function update($userId, $supplierId, $company, $firstName, $lastName, $street, $houseNumber, $zip, $city)
    {
        $query = "UPDATE $this->tablename SET $this->columnCompany = ?, $this->columnFirstName = ?, $this->columnLastName = ?, $this->columnStreet = ?, $this->columnHouseNumber = ?, $this->columnZIP = ?, $this->columnCity = ? WHERE $this->columnUserId = ? AND $this->columnId = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sssssssii', $company, $firstName, $lastName, $street, $houseNumber, $zip, $city, $userId, $supplierId);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function countSuppliers($userId)
    {
        $query = "SELECT count(*) AS 'number' FROM $this->tablename WHERE $this->columnUserId = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $userId);
        $statement->execute();
        return $this->processSingleResult($statement->get_result());
    }
}
