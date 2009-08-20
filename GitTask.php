<?php
require_once 'phing/Task.php';

class GitTask extends Task {
	public function init() {
		$this->log("TODO: Make sure we're in a git repo.");
	}

	public function main() { /* do nothing */ }
}
?>