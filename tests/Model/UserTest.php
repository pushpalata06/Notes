<?php
namespace Notes\Model;
require_once '../../vendor/autoload.php';

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateObject()
    {
        $user   = new User();
        $this->assertInstanceOf('Notes\Model\User', $user);
    }
}
