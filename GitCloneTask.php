<?php
require_once 'phing/Task.php';

class GitCloneTask extends Task {
	private $_repo;
	private $_path;

	public function setRepo($repo) {
		$this->_repo = $repo;
	}

	public function setPath($path) {
		$this->_path = $path;
	}

	public function main() {
		if(false == isset($this->_repo) || false == isset($this->_path)) {
			$this->log("GitCloneTask Fail: REPO and PATH must be set!\n");
			exit(1);
		}
		$command = "git clone " . $this->_repo . " " . $this->_path;
		$this->log("Attempting to clone '" . $this->_repo . "' into '" . $this->_path . "'");
		passthru($command, $return);
		if(intval($return) > 0) {
			$this->log("Git Clone Failed.");
			exit(1);
		}
	}
}
