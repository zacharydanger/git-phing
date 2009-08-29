<?php
require_once 'GitTask.php';

class GitGcTask extends GitTask {
	public function main() {
		$command = $this->git_path . " gc";
		passthru($command, $return);
		$this->log("Cleaing up git repo: " . $return);
	}
}
?>