<?php
require_once 'GitTask.php';

class GitSubmoduleUpdateTask extends GitTask {
	public function main() {
		$this->_initSubmodules();
		$this->_updateSubmodules();
	}

	private function _initSubmodules() {
		$command = "git submodule foreach git submodule init";
		passthru($command, $return);
		$this->log("Initializing Git Submodules: " . $return);
	}

	private function _updateSubmodules() {
		$command = "git submodule foreach git submodule update";
		passthru($command, $return);
		$this->log("Updating Git Submodules: " . $return);
	}
}
?>
