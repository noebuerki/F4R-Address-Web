<?php

namespace App\Repository;

use App\DataBase\ConnectionHandler;
use Exception;

require_once '../src/DataBase/ConnectionHandler.php';

class CustomerRepository extends Repository
{
    protected $tablename = "customer";
    private $columnUserId = "userId";
    private $columnTitle = "title";
    private $columnFirstName = "firstName";
    private $columnLastName = "lastName";
    private $columnMiddleName = "middleName";
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

    public function create($userId, $title, $firstName, $lastName, $middleName, $street, $houseNumber, $zip, $city)
    {
        $query = "INSERT INTO $this->tablename ($this->columnUserId, $this->columnTitle, $this->columnFirstName, $this->columnLastName, $this->columnMiddleName, $this->columnStreet, $this->columnHouseNumber, $this->columnZIP, $this->columnCity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('isssssss', $userId, $title, $firstName, $lastName, $middleName, $street, $houseNumber, $zip, $city);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function countCustomers($userId)
    {
        $query = "SELECT count(*) AS 'number' FROM $this->tablename WHERE $this->columnUserId = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $userId);
        $statement->execute();
        return $this->processSingleResult($statement->get_result());
    }
}
