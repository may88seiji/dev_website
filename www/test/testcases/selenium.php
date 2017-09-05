<?php

class seleniumTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
      // $this->setHost('192.168.33.5');
      // $this->setPort(4444);
        $this->setBrowserUrl('http://www.google.com');
        $this->setBrowser('*firefox');
    }

    public function testTitle()
    {
        $this->open("/");
        // echo 'TETETETTTE';
        // $this->url('http://cinra.dev/');
        // echo 'TITLE: '.$this->title();
        $this->assertTrue(false);
        // $this->assertEquals('Example WWW Page', $this->title());
    }

}


// require_once 'PHPUnit/Extensions/Selenium2TestCase.php';

// class seleniumTest extends PHPUnit_Extensions_SeleniumTestCase
// {
//   protected function setUp()
//   {
//       // $this->setBrowser('firefox');
//       // $this->setBrowserUrl('http://www.example.com/');
//   }

//   public function testTitle()
//   {
//       // $this->url('http://www.example.com/');
//       // $this->assertEquals('Example WWW Page', $this->title());
//   }
// }