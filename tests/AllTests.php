<?php
require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__) . '/GitTaskTest.php';

class GitPhing_AllTests {
	public static function suite() {
		$suite = new PHPUnit_Framework_TestSuite('GitPhing AllTests');
		$suite->addTestSuite('GitTaskTest');
		return $suite;

	}

}
?>