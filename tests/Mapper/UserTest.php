<?php
namespace Notes\Mapper;

use Notes\Mapper\User as UserMapper;


class UserTest extends \PHPUnit_Extensions_Database_TestCase
{
    
    public function getConnection()
    {
        try {
            $connectHostString = "mysql:host=localhost;dbname=notes";
            $pdo               = new \PDO($connectHostString, "root", "Dbtest123");
            return $this->createDefaultDBConnection($pdo, "notes");
            
        }
        catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getDataSet()
    {
        return $this->createXMLDataSet(dirname(__FILE__) . '/_files/user.xml');
    }

    public function testCanReadUserById()
    {
        $userMapper = new UserMapper();
        $user       = $userMapper->read('1');
        $this->assertEquals('Pushpa', $user->firstName);
    }
    public function testCheckRowCount()
    {
        $this->assertEquals(4, $this->getConnection()->getRowCount('user'));
    }

    public function testAddEntry()
    {
        $input      = array(
            'firstName' => 'Kirti',
            'lastName' => 'Bhoye',
            'color' => 'Yellow'
        );
        $userMapper = new UserMapper();
        $user = $userMapper->create($input);
        $queryTable    = $this->getConnection()->createQueryTable('user', 'select id, firstName, lastName, color, isDelete from user');
        $expectedTable = $this->createXMLDataSet(dirname(__FILE__) . '/_files/user_after_insert.xml')->getTable("user");
        $this->assertTablesEqual($expectedTable, $queryTable);
    }


    public function testUpdateEntry()
    {
        $userMapper = new UserMapper();
        $user = $userMapper->update('1');
        $queryTable    = $this->getConnection()->createQueryTable('user', 'select * from user');
        $expectedTable = $this->createXMLDataSet(dirname(__FILE__) . '/_files/after_user_update.xml')->getTable("user");
        $this->assertTablesEqual($expectedTable, $queryTable);
        
    }
    
    
    
    public function testCanReadAllUsers()
    {
        $queryTable    = $this->getConnection()->createQueryTable('user', 'select * from user');
        $expectedTable = $this->createXMLDataSet(dirname(__FILE__) . '/_files/user.xml')->getTable("user");
        $this->assertTablesEqual($expectedTable, $queryTable);
    }
    public function testDeleteEntry()
    {
        
        $userMapper = new UserMapper();
        $user = $userMapper->delete('2');
        $queryTable    = $this->getConnection()->createQueryTable('user', 'select * from user');
        $expectedTable = $this->createXMLDataSet(dirname(__FILE__) . '/_files/after_user_delete.xml')->getTable("user");
        $this->assertTablesEqual($expectedTable, $queryTable);
        
    }
}
