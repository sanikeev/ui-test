<?php
class WebTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://sanikeev.spoline.dev/');
    }

    public function testTitle()
    {
        $this->url('/');
        $this->assertEquals('SPOline.RU поисково-учетная система', $this->title());
    }
    
    public function testAuthUser() {
        $this->url('/');
        $usernameInput = $this->byId('login');
        $usernameInput->value('web-hp@mail.ru');
        $this->assertEquals('web-hp@mail.ru', $usernameInput->value());
        
        $passwordInput = $this->byId('password');
        $passwordInput->value('qwerty');
        $this->assertEquals('qwerty', $passwordInput->value());
        
        $this->clickOnElement('button_auth');
        $this->timeouts()->implicitWait(5000);
        $logout = $this->byId('button_logout');
        $this->assertEquals('Выход', $logout->text());
    }

}
?>
