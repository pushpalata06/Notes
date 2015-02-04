<?php
namespace Notes\Mapper;

use Notes\Model\User as UserModel;

require_once '../../vendor/autoload.php';

class User
{
    public function update($id)
    {
        try {
            $user     = new UserModel();
            $user->id = $id;
            $conn     = new \PDO("mysql:host=localhost;dbname=notes", "root", "Dbtest123");
            
            $sql  = "UPDATE user SET firstName='ggg' WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':id' => $user->id));
                return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        
        $conn = null;
        
    }
    
    public function delete($id)
    {
        try {
            $user     = new UserModel();
            $user->id = $id;
            $conn     = new \PDO("mysql:host=localhost;dbname=notes", "root", "Dbtest123");
            
            $sql = "delete from user where id=:id";
            $q   = $conn->prepare($sql);
            $q->execute(array(
                ':id' => $user->id
            ));
            $resultset = $q->fetch(\PDO::FETCH_ASSOC);
            return $user;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        $conn = null;
    }
    public function create($input)
    {
        try {
            $user = new UserModel();
            $user->firstName = $input['firstName'];
            $user->lastName  = $input['lastName'];
            $user->color     = $input['color'];
            
            $conn = new \PDO("mysql:host=localhost;dbname=notes", "root", "Dbtest123");
            
            $sql = "INSERT INTO user (firstName,lastName,color) VALUES (:firstName,:lastName,:color)";
            $q   = $conn->prepare($sql);
            $q->execute(array(
                ':firstName' => $user->firstName,
                ':lastName' => $user->lastName,
                ':color' => $user->color
            ));
            $user->id = $conn->lastInsertId();
            
            return $user;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        $conn = null;
    }
    
    
    public function read($id)
    {
        try {
            $user     = new UserModel();
            $user->id = $id;
            $conn     = new \PDO("mysql:host=localhost;dbname=notes", "root", "Dbtest123");
            
            $sql = "select id,firstName,lastName,color from user where id=:id";
            $q   = $conn->prepare($sql);
            $q->execute(array(
                ':id' => $user->id
            ));
            $resultset = $q->fetch(\PDO::FETCH_ASSOC);
            
            if ($q->rowCount() == 0) {
                throw new \Exception("User not found.");
            } else {
                $user->firstName = $resultset['firstName'];
                $user->lastName  = $resultset['lastName'];
                $user->email     = $resultset['color'];
                
                
                return $user;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        $conn = null;
    }
}
