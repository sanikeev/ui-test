<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewEventTest
 *
 * @author user
 */
class ViewEventTest extends PHPUnit_Extensions_Selenium2TestCase {

    protected function setUp() {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://sanikeev.spoline.dev/');
    }

    public function testShowEventsBlockOnPage() {
        $this->url('/');
        $usernameInput = $this->byId('login');
        $usernameInput->value('web-hp@mail.ru');
        $passwordInput = $this->byId('password');
        $passwordInput->value('qwerty');
        $this->clickOnElement('button_auth');
        $this->url('/profile/');
        $blockName = $this->byCssSelector('div.content_in:nth-child(4) > div:nth-child(1) > a:nth-child(1)')->text();
        $this->assertEquals('События', $blockName);
        $blockContent = $this->byCssSelector('.event_content')->displayed();
        $this->assertTrue($blockContent);
    }
    
    /**
     * 
     * @depends testShowEventsBlockOnPage
     */
    public function testShowUserOwnEventsOnArticleCategory() {
        $this->url('/');
        $usernameInput = $this->byId('login');
        $usernameInput->value('web-hp@mail.ru');
        $passwordInput = $this->byId('password');
        $passwordInput->value('qwerty');
        $this->clickOnElement('button_auth');
        $this->url('/profile/');
        $link = $this->byCssSelector('div.content_in:nth-child(4) > div:nth-child(1) > a:nth-child(2)');
        $link->click();
        $block = $this->byCssSelector('li.content_block')->displayed();
        $this->assertTrue($block);
    }

}
