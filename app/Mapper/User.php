<?php
namespace Notes\Mapper;

use Notes\Model\User as UserModel;

use Notes\Database\Database as Database;

class User
{
    public function delete($id)
    {
        $isDelete = 0;
        $user     = new UserModel();
        $user->id = $id;
        $user->isDelete = $isDelete;
        $db  = new Database();
        $sql = "UPDATE user SET isDelete=:isDelete WHERE id=:id";
        $resultset = $db->delete($id, $isDelete, $sql);
        return $resultset;
    }
    public function create($input)
    {
        
        $user            = new UserModel();
        $user->firstName = $input['firstName'];
        $user->lastName = $input['lastName'];
        $user->color    = $input['color'];
        $sql            = "INSERT INTO user (firstName, lastName, color) VALUES (:firstName, :lastName, :color)";
        $db             = new Database();
        $resultset      = $db->put($input, $sql);
        return $resultset;
    }
    
   
    public function read($id)
    {
        $user     = new UserModel();
        $user->id = $id;
        
        $sql = "SELECT id, firstName, lastName,color FROM user where id=:id";
        
        $db              = new Database();
        $resultset       = $db->get($id, $sql);
        $user->firstName = $resultset['firstName'];
        $user->lastName  = $resultset['lastName'];
        $user->color     = $resultset['color'];
        
        return $user;
    }
 
    public function update($id)
    {
        $user            = new UserModel();
        $user->id        = $id;
        $updateColorName = "Grey";
        $user->color        = $updateColorName;
        $sql             = "UPDATE user SET color=:color WHERE id=:id";
        $db              = new Database();
        $resultset       = $db->update($updateColorName,$id, $sql);
        return $resultset;  
    }
}
