<?php

class wordpressTest extends PHPUnit_Framework_TestCase
{
  public function testConfig()
  {
    $this->assertEquals( DB_NAME, 'cinra_test' );
    $this->assertEquals( WP_TESTS_DOMAIN, 'cinra.dev' );
  }

  public function testWp()
  {
    $this->assertEquals( get_option('template'), 'bootstrap' );
    $this->assertEquals( get_option('stylesheet'), 'bootstrap' );

    $this->assertTrue( function_exists('get_permalink') );
  }

  public function testCwp()
  {

    $this->assertTrue( function_exists('do_404') );
    $this->assertTrue( function_exists('is_bot') );
    $this->assertTrue( function_exists('get_uri_segment') );
    $this->assertTrue( function_exists('script_cleanup') );
    $this->assertTrue( function_exists('get_canonical_url') );

  }

  public function testAcfInstalled()
  {
    $this->assertTrue( function_exists('get_field') );
  }
}