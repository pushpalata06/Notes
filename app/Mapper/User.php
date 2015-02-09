<?php
namespace Notes\Mapper;

use Notes\Model\User as UserModel;

use Notes\Database\Database as Database;

class User
{
    public function delete($id)
    {
        
        $user     = new UserModel();
        $user->id = $id;
        
        $db  = new Database();
        $sql = "delete from user where id=$id";
        $resultset = $db->delete($sql);
        return $resultset;
    }
    public function create($input)
    {
        
        $user            = new UserModel();
        $user->firstName = $input['firstName'];
        
        $user->lastName = $input['lastName'];
        $user->color    = $input['color'];
        
        $sql       = "INSERT INTO user (firstName,lastName,color) VALUES 
                        ('$user->firstName', '$user->lastName', '$user->color')";
        $db        = new Database();
        $resultset = $db->put($sql);
        return $resultset;
    }
    
    
    public function read($id)
    {
        $user     = new UserModel();
        $user->id = $id;
        
        $sql = "SELECT id, firstName, lastName,color FROM user where id=$id";
        
        $db              = new Database();
        $resultset       = $db->get($sql);
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
        $sql             = "UPDATE user SET color='$updateColorName' WHERE id=$id";
        $db              = new Database();
        $resultset       = $db->update($sql);
        return $resultset;  
    }
}
