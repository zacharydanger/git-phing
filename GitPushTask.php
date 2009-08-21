<?php
require_once 'GitTask.php';

class GitPushTask extends GitTask {
	private $_remote;
	private $_branch;

	public function main() {
		$command = "git push " . $this->_remote . " " . $this->_branch;
		$this->log("Pushing: " . $command);
		passthru($command, $return);
		$this->log("Push Return: " . $return);
	}

	public function setRemote($remote) {
		$this->_remote = $remote;
	}

	/**
	 * OPTIONAL: Set the branch for the git push command.
	 */
	public function setBranch($branch) {
		$this->_branch = $branch;
	}
}
?>
