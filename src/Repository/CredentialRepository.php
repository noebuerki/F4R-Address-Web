<?php

namespace App\Repository;

use App\DataBase\ConnectionHandler;
use Exception;

require_once '../src/DataBase/ConnectionHandler.php';

class CredentialRepository extends Repository
{
    protected $tablename = "credentials";
    private $columnUserId = "userId";
    private $columnClientId = "title";
    private $columnClientSecret = "firstName";
    private $columnFrankingNumber = "lastName";

    /* Database-Statements */
    public function readByUserId($userId)
    {
        $query = "SELECT * FROM $this->tablename WHERE $this->columnUserId = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $userId);
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

    public function create($userId, $clientId, $clientSecret, $frankingNumber)
    {
        $query = "INSERT INTO $this->tablename ($this->columnUserId, $this->columnClientId, $this->columnClientSecret, $this->columnFrankingNumber) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('isss', $userId, $clientId, $clientSecret, $frankingNumber);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
}
