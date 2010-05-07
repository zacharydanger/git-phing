<?php
require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__) . '/../GitCloneTask.php';

class GitCloneTaskTest extends PHPUnit_Framework_TestCase {
	static $test_repo = 'test@test.foobar.foo:foobar.git';
	static $directory = '/tmp/test-clone';

	/**
	 * @expectedException BuildException
	 */
	public function testMain_NoRepo_BuildException() {
		$GCT = new GitCloneTask();
		$GCT->setPath(self::$directory);
		$GCT->main();
	}

	/**
	 * @expectedException BuildException
	 */
	public function testMain_NoPath_BuildException() {
		$GCT = new GitCloneTask();
		$GCT->setRepo(self::$test_repo);
		$GCT->main();
	}

	/**
	 * @expectedException BuildException
	 */
	public function testMain_BadClone_BuildException() {
		$mock_git = $this->getMock('VersionControl_Git');
		$mock_git->expects($this->once())
			->method('createClone')
			->with(self::$test_repo, false, self::$directory)
			->will($this->throwException(new VersionControl_Git_Exception("Foobar")));
		$GCT = $this->_getCloneTask();
		$GCT->setGit($mock_git);
		$GCT->setRepo(self::$test_repo);
		$GCT->setPath(self::$directory);
		$GCT->main();
	}

	public function testMain_GoodClone() {
		$remote_repo = 'test@test.foobar.foo:foobar.git';

		$mock_git = $this->getMock('VersionControl_Git');
		$mock_git->expects($this->once())
			->method('createClone')
			->with(self::$test_repo, false, self::$directory);

		$GCT = $this->_getCloneTask();
		$GCT->setGit($mock_git);
		$GCT->setRepo(self::$test_repo);
		$GCT->setPath(self::$directory);
		$GCT->main();
	}

	protected function _getCloneTask() {
		$GCT = new GitCloneTask();
		$GCT->setProject($this->getMock('Project'));
		return $GCT;

	}
}
?>
