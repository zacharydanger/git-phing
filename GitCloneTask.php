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
	private $_onexisting;

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
	 * Sets the behaviour if path exists.
	 */
	public function setOnexisting($onexisting) {
		$this->_onexisting = $onexisting;
	}

	/**
	 * The main entry.
	 */
	public function main() {
		if(false == isset($this->_repo) || false == isset($this->_path)) {
			$this->log("GitCloneTask Fail: REPO and PATH must be set!\n");
			exit(1);
		}
		if ( file_exists($this->_path) ) {
			switch($this->_onexisting) {
				case 'replace':
					if ( ! $this->recursiveRmDir($this->_path) ) {
						$this->log("GitCloneTask Fail: PATH could not be deleted!\n");
						exit(1);
					};
					break;
				case 'ignore':
					if ( file_exists($this->_path . '/.git/config') ) {
    					// Ignore, just return.
    					return;
					} else {
                        $this->log("GitCloneTask Fail: PATH already exists but does not look like a Git repository!\n");
                        exit(1);
					}
					break;
				case 'fail':
				default:
					$this->log("GitCloneTask Fail: PATH already exists!\n");
					exit(1);
					break;
			}
		}
		$command = $this->git_path . " clone " . $this->_repo . " " . $this->_path;
		$this->log("Attempting to clone '" . $this->_repo . "' into '" . $this->_path . "'");
		$this->log("Running " . $command);
		passthru($command, $return);
		if(intval($return) > 0) {
			$this->log("Git Clone Failed.");
			exit(1);
		}
	}
}
