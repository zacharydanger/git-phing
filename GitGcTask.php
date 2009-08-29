<?php
require_once 'GitTask.php';

/**
 * Runs `git gc` in the local dir.
 *
 * @author Zach Campbell <zacharydangercampbell@gmail.com>
 */
class GitGcTask extends GitTask {
	/**
	 * Main entry.
	 */
	public function main() {
		$command = $this->git_path . " gc";
		passthru($command, $return);
		$this->log("Cleaing up git repo: " . $return);
	}
}
?>