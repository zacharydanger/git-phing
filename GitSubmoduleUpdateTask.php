<?php
require_once 'GitTask.php';

/**
 * Initializes and updates git submodules.
 *
 * @author Zach Campbell <zacharydangercampbell@gmail.com>
 */
class GitSubmoduleUpdateTask extends GitTask {
	/**
	 * Main entry point.
	 */
	public function main() {
		$this->_initSubmodules();
		$this->_updateSubmodules();
	}

	/**
	 * Initializes submodules.
	 */
	private function _initSubmodules() {
		$command = "git submodule foreach git submodule init";
		passthru($command, $return);
		$this->log("Initializing Git Submodules: " . $return);
	}

	/**
	 * Updates submodules.
	 */
	private function _updateSubmodules() {
		$command = "git submodule foreach git submodule update";
		passthru($command, $return);
		$this->log("Updating Git Submodules: " . $return);
	}
}
?>
