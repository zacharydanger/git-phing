<?php
require_once 'GitTask.php';

class GitGcTask extends GitTask {
	public function main() {
		$command = "git gc";
		passthru($command, $return);
		$this->log("Cleaing up git repo: " . $return);
	}
}
?>