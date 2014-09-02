<?php
class BCRegisterTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://booking2.onlinevoyage.ru//');
    }

    public function testTitle()
    {
        $this->url('/');
        $this->assertEquals('Авторизация', $this->title());
    }
    
    public function testAuthUser() {
        $this->url('/');
        $this->clickOnElement('button_register_show');
        $this->timeouts()->implicitWait(5000);
       
        
        
        $usernameInput = $this->byId('user_sname');
        $usernameInput->value('Сидоров');
        $this->assertEquals('Сидоров', $usernameInput->value());
        
        $userfnameInput = $this->byId('user_fname');
        $userfnameInput->value('Иван');
        $this->assertEquals('Иван', $userfnameInput->value());
        
        $usermnameInput = $this->byId('user_middle_name');
        $usermnameInput->value('Иванович');
        $this->assertEquals('Иванович', $usermnameInput->value());
        
        $emailInput = $this->byId('user_login');
        $emailInput->value('sanikeev@spoline.ru');
        $this->assertEquals('sanikeev@spoline.ru', $emailInput->value());
        
        $passwordInput = $this->byId('user_password');
        $passwordInput->value('qwerty');
        $this->assertEquals('qwerty', $passwordInput->value());
        
        $agencyNameSimpleInput = $this->byId('agency_name');
        $agencyNameSimpleInput->value('Супертур');
//        $this->assertEquals('супертур',  $agencyNameSimpleInput->value());
        
        $agencyNameFullInput = $this->byId('agency_fullname');
        $agencyNameFullInput->value('ООО «Супертур»');
        $this->assertEquals('ООО «Супертур»', $agencyNameFullInput->value());
        
        
        // select city
        $citySelect = $this->select($this->byId('agency_area_id'));
        $citySelect->selectOptionByLabel('Москва');
        $this->assertEquals('2019', $citySelect->selectedValue());
        
        
        
        $factAddressInput = $this->byId('agency_fact_address');
        $factAddressInput->value('107078, г.Москва, Большой Харитоньевский пер., д. 16-18');
        $this->assertEquals('107078, г.Москва, Большой Харитоньевский пер., д. 16-18', $factAddressInput->value());
        
        $yurAddressInput = $this->byId('agency_legal_address');
        $yurAddressInput->value('107078, г.Москва, Большой Харитоньевский пер., д. 16-18');
        $this->assertEquals('107078, г.Москва, Большой Харитоньевский пер., д. 16-18', $yurAddressInput->value());
        
        $phoneNumberInput = $this->byId('agency_phone');
        $phoneNumberInput->value('8(920)1234567');
        $this->assertEquals('8(920)1234567', $phoneNumberInput->value());
        
        $cellNumberInput = $this->byId('agency_phone2');
        $cellNumberInput->value('8(920)1234567');
        $this->assertEquals('8(920)1234567', $cellNumberInput->value());
        
        $faxNumberInput = $this->byId('agency_fax');
        $faxNumberInput->value('8(920)1234567');
        $this->assertEquals('8(920)1234567', $faxNumberInput->value());
        
        $webSiteNameInput = $this->byId('agency_web_site');
        $webSiteNameInput->value('www.site.ru');
        $this->assertEquals('www.site.ru', $webSiteNameInput->value());
        
        $agencyEmailInput = $this->byId('agency_email');
        $agencyEmailInput->value('info@mail.ru');
        $this->assertEquals('info@mail.ru', $agencyEmailInput->value());
        
        // select nds
        $ndsSelect = $this->select($this->byId('agency_nds_type'));
        $ndsSelect->selectOptionByLabel('Обычный');
        $this->assertEquals('223', $ndsSelect->selectedValue());
        
        
        $innInput = $this->byId('agency_inn');
        $innInput->value('1234567890');
        $this->assertEquals('1234567890', $innInput->value());
        
        $kppInput = $this->byId('agency_kpp');
        $kppInput->value('123456789');
        $this->assertEquals('123456789', $kppInput->value());
        
        $ksInput = $this->byId('agency_k_s');
        $ksInput->value('12345678901234567890');
        $this->assertEquals('12345678901234567890', $ksInput->value());
        
        $bankInput = $this->byId('agency_bank');
        $bankInput->value('Sberbank');
        $this->assertEquals('Sberbank', $bankInput->value());
        
        $rsInput = $this->byId('agency_p_s');
        $rsInput->value('12345678901234567890');
        $this->assertEquals('12345678901234567890', $rsInput->value());
        
        $bikInput = $this->byId('agency_bik');
        $bikInput->value('123456789');
        $this->assertEquals('123456789', $bikInput->value());
        
        $buhInput = $this->byId('agency_buh');
        $buhInput->value('Иванов');
        $this->assertEquals('Иванов', $buhInput->value());
        
        $text = $this->byId('agency_comments');
        $text->value('some text');
        
        sleep(10); // засыпаем чтобы ввести капчу
        
        $registerButton = $this->byId('agencyAddInBookingcenter');
        $registerButton->click();
        
        $this->timeouts()->implicitWait(10000);
        $regSuccess = $this->byClassName('vs_info');
        $this->assertRegExp('/Регистрация прошла.*?/', $regSuccess->text());
        sleep(5);
    }

}
?>

