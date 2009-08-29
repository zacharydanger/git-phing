<?php
require_once 'phing/Task.php';

/**
 * Base class for Git Tasks.
 *
 * @author Zach Campbell <zacharydangercampbell@gmail.com>
 */
class GitTask extends Task {
	/**
	 * Path to git executable.
	 */
	public $git_path = 'git';

	/**
	 * Main initialization, does nothing.
	 */
	public function init() { /* do nothing */ }

	/**
	 * Optionally set the path to git.
	 */
	public function setGitPath($git_path) {
		$this->git_path = $git_path;
	}

	/**
	 * Main entry. Does nothing.
	 */
	public function main() { /* do nothing */ }
}
?>