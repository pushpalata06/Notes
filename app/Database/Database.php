<?php
namespace Notes\Database;

use Notes\Config\Config as Config;

class Database
{
    public $conn;
    
    public function getConnection()
    {
        try {
            $config = new Config();
            $connectHostString = "mysql:host=$config->hostName;dbname=$config->dbName";
            $this->conn = new \PDO($connectHostString, $config->userName, $config->password);
            return $this->conn;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function get($id, $sql)
    {
        $stmt = $this->getConnection()->prepare($sql);
        
        $stmt->execute(array(':id'=> $id));
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
    public function put($input, $sql)
    {
        $conn   = $this->getConnection();
        $result = $conn->prepare($sql);
        $result->execute($input);
        $lastInsertid = $conn->lastInsertId();
        return $lastInsertid;
    }
    
    public function delete($id, $isDelete, $sql)
    {
        $conn   = $this->getConnection();
        $result = $conn->prepare($sql);
        $result->execute(array(':id' => $id, ':isDelete' => $isDelete));
        return "Record deleted successfully";
        
    }
    
    public function update($updateColorName, $id, $sql)
    {
        $conn = $this->getConnection();
        $result = $conn->prepare($sql);
        $result->execute(array(':id'=> $id, ':color' => $updateColorName));
        $result = $result->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
}
