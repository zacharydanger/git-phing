<?php
require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__) . '/../GitTask.php';

class GitTaskTest extends PHPUnit_Framework_TestCase {
	public function testSetGitPath() {
		$expected_path = '/usr/local/bin/git';
		$mock_git = $this->getMock('VersionControl_Git');
		$mock_git->expects($this->once())
			->method('setGitCommandPath')
			->with($expected_path);
		$GT = new GitTask();
		$GT->setGit($mock_git);
		$GT->setGitPath($expected_path);
	}
}
?>
