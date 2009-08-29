<?php
require_once 'phing/Task.php';

class GitTask extends Task {
	/**
	 * Path to git executable.
	 */
	public $git_path = 'git';

	public function init() { /* do nothing */ }

	/**
	 * Optionally set the path to git.
	 */
	public function setGitPath($git_path) {
		$this->git_path = $git_path;
	}

	public function main() { /* do nothing */ }
}
?>