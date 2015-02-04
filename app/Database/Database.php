<?php
namespace Notes\Database;


class Database 
{
    public function getConnection()
    {
        
        try {
            $pdo = new \PDO('mysql:host=DB_SERVER;dbname=DB_NAME', DB_USER, DB_PASSWORD);
            $this->conn = $this->createDefaultDBConnection($pdo, DB_NAME);
            return $this->conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function get($query)
    {
            $stmt   = $conn->prepare($query);
            $stmt->execute(array(
                ':id' => $user->id
            ));
            $resultset = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $resultset;
    }
}
