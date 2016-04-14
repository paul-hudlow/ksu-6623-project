<?php
require_once('../CompanyCalendar/Modules/LoginModule.php');
class LoginModuleTests extends PHPUnit_Framework_TestCase
{
	public function testBuildModel_FailedAttempt()
	{
		$loginModule = new LoginModule();
		
		$model = $loginModule->BuildModel(true);
		$this->assertEquals("Login failed.", $model['error']);
	}
	
	public function testBuildModel_NoAttempt()
	{
		$loginModule = new LoginModule();
		
		$model = $loginModule->BuildModel(false);
		$this->assertFalse(isset($model['error']));
	}
	
	public function testLogin_Sucess()
	{
		$fakeLoginTool = $this->getMock('uLogin');
    	$fakeLoginTool->expects($this->once())->method('Authenticate');
    	$fakeLoginTool->method('IsAuthSuccess')->willReturn(true);
    	$fakeLoginTool->method('Uid')->willReturn("fakeUid");
    	$loginModule = new LoginModule();
    	$loginModule->ulogin = $fakeLoginTool;
    	
    	$loginResult = $loginModule->Login('username', 'password');
    	
		$this->assertTrue($loginResult);
		$this->assertEquals("fakeUid", $_SESSION['uid']);
		$this->assertEquals("username", $_SESSION['username']);
		$this->assertTrue($_SESSION['loggedIn']);
	}
	
	public function testLogin_Failure()
	{
		$fakeLoginTool = $this->getMock('uLogin');
    	$fakeLoginTool->expects($this->once())->method('Authenticate');
    	$fakeLoginTool->method('IsAuthSuccess')->willReturn(false);
    	$fakeLoginTool->method('Uid')->willReturn("fakeUid");
    	$loginModule = new LoginModule();
    	$loginModule->ulogin = $fakeLoginTool;
    	
    	$loginResult = $loginModule->Login('username', 'password');
    	
		$this->assertFalse($loginResult);
		$this->assertFalse(isset($_SESSION['uid']));
		$this->assertFalse(isset($_SESSION['username']));
		$this->assertFalse(isset($_SESSION['loggedIn']));
	}
	
	public function testLogout()
	{
		$fakeLoginTool = $this->getMock('uLogin');
    	$fakeLoginTool->expects($this->once())->method('Logout');
    	$loginModule = new LoginModule();
    	$loginModule->ulogin = $fakeLoginTool;
    	
    	$_SESSION['uid'] = 'fake';
		$_SESSION['username'] = 'fake';
		$_SESSION['loggedIn'] = 'fake';
    	$loginModule->Logout();
    	
		$this->assertFalse(isset($_SESSION['uid']));
		$this->assertFalse(isset($_SESSION['username']));
		$this->assertFalse(isset($_SESSION['loggedIn']));
	}
}
?>