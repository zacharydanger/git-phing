<?php
require_once 'GitTask.php';

/**
 * Creates a new tag in git.
 *
 * @author Zach Campbell <zacharydangercampbell@gmail.com>
 */
class GitTagTask extends GitTask {
	private $_tag_name;

	/**
	 * Sets the name for the new git tag.
	 */
	public function setTag($tag_name) {
		$this->_tag_name = $tag_name;
	}

	/**
	 * Main entry point.
	 */
	public function main() {
		$cmd = $this->git_path . " tag " . $this->_tag_name;
		$this->log("Running " . $cmd);
		passthru($cmd, $return);
		$this->log("Return: " . $return);
	}
}
?>
