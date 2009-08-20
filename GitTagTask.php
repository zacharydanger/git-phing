<?php
require_once 'GitTask.php';

class GitTagTask extends GitTask {
	private $_tag_name;

	public function setTag($tag_name) {
		$this->_tag_name = $tag_name;
	}

	public function main() {
		$cmd = "git tag " . $this->_tag_name;
		$this->log("Running " . $cmd);
		passthru($cmd, $return);
		$this->log("Return: " . $return);
	}
}
?>
