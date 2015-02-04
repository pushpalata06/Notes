<?php
namespace Notes\Mapper;

require_once '../../vendor/autoload.php';

use Notes\Mapper\User as UserMapper;

class UserTest extends \PHPUnit_Extensions_Database_TestCase
{
    
    public function getConnection()
    {
        try {
            $pdo = new \PDO('mysql:host=localhost;dbname=notes', 'root', 'Dbtest123');
            return $this->createDefaultDBConnection($pdo, "notes");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
    }
    public function getDataSet()
    {
        return $this->createXMLDataSet(dirname(__FILE__) . '/_files/user.xml');
    }
    
    public function testIsCountIncreased()
    {
        $this->assertEquals(3, $this->getConnection()->getRowCount('user'), "Pre-Condition");
        
        
        $input      = array(
            'firstName' => 'Tony1',
            'lastName' => 'Stark1',
            'color' => 'grey1'
        );
        $userMapper = new UserMapper();
        
        $userMapper->create($input);
        
        $this->assertEquals(4, $this->getConnection()->getRowCount('user'), "Inserting failed");
        
    }
    
    public function testIsCountDecreased()
    {
        
        
        $this->assertEquals(3, $this->getConnection()->getRowCount('user'), "Pre-Condition");
        
        $userMapper = new UserMapper();
        
        $userMapper->delete('3');
        
        $this->assertEquals(2, $this->getConnection()->getRowCount('user'), "Inserting failed");
        
    }
    
    public function testIsUpdate()
    {
        $userMapper = new UserMapper();
        
        $this->assertEquals(true, $userMapper->update('1'));
        
    }
    
    public function testCanReadUserById()
    {
        $userMapper = new UserMapper();
        $user       = $userMapper->read('1');
        $this->assertEquals('anusha', $user->firstName);
    }
}
