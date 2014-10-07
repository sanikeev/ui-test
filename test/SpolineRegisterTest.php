<?php

class SpolineRegisterTest extends PHPUnit_Extensions_Selenium2TestCase {

    protected function setUp() {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://sanikeev.spoline.dev/');
    }

    public function testRegisterForm() {
        $this->url('/');
        // кликаем по блоку с регистрцией
        $element = $this->byCssSelector('.reg_area');
        $element->click();
        $this->timeouts()->implicitWait(5000);
        $loginInputEl = $this->byCssSelector('div.reg_wrap:nth-child(2) > div:nth-child(1) > form:nth-child(1) > fieldset:nth-child(1) > input:nth-child(2)');
        $passwordEl = $this->byCssSelector('div.reg_wrap:nth-child(2) > div:nth-child(1) > form:nth-child(1) > fieldset:nth-child(1) > input:nth-child(4)');
        $registerButtonEl = $this->byCssSelector('div.reg_wrap:nth-child(2) > div:nth-child(1) > form:nth-child(1) > div:nth-child(2) > div:nth-child(1)');

        // проверяем, что все поля формы видны 
        $this->assertTrue($loginInputEl->displayed());
        $this->assertTrue($passwordEl->displayed());
        $this->assertTrue($registerButtonEl->displayed());

        // проверяем валидацию поля почты
        $loginInputEl->value('123123rfdfdf');
        $registerButtonEl->click();

        $this->assertRegExp('/alert-error/', $loginInputEl->attribute('class'));

        // проверяем валидацию поля пароля
        $passwordEl->value('2345');

        $this->assertRegExp('/alert-error/', $passwordEl->attribute('class'));

        $userLogin = 'mail' . rand(1000, 10000) . '@mail.ru';
        // проверяем собственно заполнение формы регистрации и отправкку данных
        $loginInputEl->value($userLogin);
        $passwordEl->value('qwerty123');
        
        $registerButtonEl->click();
        $this->timeouts()->implicitWait(3000);
        sleep(6);
        $elem = $this->byCssSelector('.content_in');
        $this->assertRegExp('/.*Доступ.*закрыт.*?/', $elem->text());
    }

}
