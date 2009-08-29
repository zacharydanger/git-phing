<?php
require_once 'GitTask.php';

/**
 * Clones a git repository to a local directory.
 *
 * @author Zach Campbell <zacharydangercampbell@gmail.com>
 */
class GitCloneTask extends GitTask {
	private $_repo;
	private $_path;

	/**
	 * Sets the repository to clone.
	 */
	public function setRepo($repo) {
		$this->_repo = $repo;
	}

	/**
	 * Sets the target path for the cloned repository.
	 */
	public function setPath($path) {
		$this->_path = $path;
	}

	/**
	 * The main entry.
	 */
	public function main() {
		if(false == isset($this->_repo) || false == isset($this->_path)) {
			$this->log("GitCloneTask Fail: REPO and PATH must be set!\n");
			exit(1);
		}
		$command = $this->git_path . " clone " . $this->_repo . " " . $this->_path;
		$this->log("Attempting to clone '" . $this->_repo . "' into '" . $this->_path . "'");
		passthru($command, $return);
		if(intval($return) > 0) {
			$this->log("Git Clone Failed.");
			exit(1);
		}
	}
}
