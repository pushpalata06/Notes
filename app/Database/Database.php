<?php
namespace Notes\Database;

use Notes\Config\Config as config;

class Database
{
    public $conn;
    
    public function getConnection()
    {
        try {
            $connection = new config();
            $connectHostString = "mysql:host=$connection->hostName;dbname=$connection->dbName";
            $this->conn = new \PDO($connectHostString, $connection->userName, $connection->password);
            return $this->conn;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function get($sql)
    {
        $stmt = $this->getConnection()->prepare($sql);
        
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
    public function put($sql)
    {
        
        $conn   = $this->getConnection();
        $result = $conn->prepare($sql);
        $result->execute();
        $lastInsertid = $conn->lastInsertId();
        return $lastInsertid;
    }
    
    public function delete($sql)
    {
        $conn   = $this->getConnection();
        $result = $conn->prepare($sql);
        $result->execute();
        return "Record deleted successfully";
        
    }
    
    public function update($sql)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return "Record updated successfully";
    }
}
