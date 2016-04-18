<?php
require_once(dirname(__FILE__).'/../billcode/sofortLibBillcode.inc.php');
require_once('sofortLibTest.php');

class Unit_SofortLibBillcodeTest extends SofortLibTest {
	
	protected $_classToTest = 'SofortLibBillcode';
	
	public function testCreateBillcode() {
		$validate_only = self::_getProperty('_validateOnly', $this->_classToTest);
		$SofortLibBillcode = new SofortLibBillcode(self::$configkey);
		$AbstractDataHandler = $this->getMockForAbstractClass('AbstractDataHandler',
				array(),
				'',
				FALSE,
				TRUE,
				TRUE,
				array('handle', 'getRequest', 'getRawResponse'));
		
		$validate_only->setValue($SofortLibBillcode, true);
		$SofortLibBillcode->setDataHandler($AbstractDataHandler);
		$SofortLibBillcode->createBillcode();
	}
	
	
	public function testGetBillcode() {
		$SofortLibBillcode = new SofortLibBillcode(self::$configkey);
		$this->assertFalse($SofortLibBillcode->getBillcode());
		
		$response = self::_getProperty('_response', $this->_classToTest);
		$billcode = '4711';
		$test['new_billcode']['billcode']['@data'] = $billcode;
		$response->setValue($SofortLibBillcode, $test);
		$this->assertEquals($billcode, $SofortLibBillcode->getBillcode());
	}
	
	
	public function testGetBillcodeUrl() {
		$SofortLibBillcode = new SofortLibBillcode(self::$configkey);
		$this->assertFalse($SofortLibBillcode->getBillcodeUrl());
		
		$response = self::_getProperty('_response', $this->_classToTest);
		$billcode = 'http://www.google.de/4711';
		$test['new_billcode']['billcode_url']['@data'] = $billcode;
		$response->setValue($SofortLibBillcode, $test);
		$this->assertEquals($billcode, $SofortLibBillcode->getBillcodeUrl());
	}


	public function testSetAbortUrl() {
		$SofortLibBillcode = new SofortLibBillcode(self::$configkey);
		$url = 'http://www.sofort.com';
		$this->assertEquals($SofortLibBillcode->setAbortUrl($url), $SofortLibBillcode);
	}
	
	
	public function testSetEndDate() {
		$SofortLibBillcode = new SofortLibBillcode(self::$configkey);
		
		$date = '2013-07-11 14:37:00';
		$this->assertEquals($SofortLibBillcode->setEndDate($date), $SofortLibBillcode);
		
		$received = $SofortLibBillcode->getParameters();
		$this->assertEquals($date, $received['end_date']);
	}


	public function testSetSuccessUrl() {
		$SofortLibBillcode = new SofortLibBillcode(self::$configkey);
		$url = 'http://www.sofort.com';
		$this->assertEquals($SofortLibBillcode->setSuccessUrl($url), $SofortLibBillcode);
	}
	
	
	public function testSetTimeoutUrl() {
		$SofortLibBillcode = new SofortLibBillcode(self::$configkey);
		$url = 'http://www.sofort.com';
		$this->assertEquals($SofortLibBillcode->setTimeoutUrl($url), $SofortLibBillcode);
	}
	
	
	public function testSofortLibBillcode() {
		$SofortLibBillcode = new SofortLibBillcode(self::$configkey);
		$this->assertAttributeEquals('billcode', '_rootTag', $SofortLibBillcode);
	}
}
