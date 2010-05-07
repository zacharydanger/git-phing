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
		$git = $this->getGit();
		try {
			$git->getCommand('submodule')
				->addArgument('foreach')
				->addArgument('git')
				->addArgument('submodule')
				->addArgument('init')
				->execute();
		} catch(VersionControl_Git_Exception $e) {
			throw new BuildException($e->getMessage());
		}
	}

	/**
	 * Updates submodules.
	 */
	private function _updateSubmodules() {
		$git = $this->getGit();
		try {
			$git->getCommand('submodule')
				->addArgument('foreach')
				->addArgument('git')
				->addArgument('submodule')
				->addArgument('update')
				->execute();
		} catch(VersionControl_Git_Exception $e) {
			throw new BuildException($e->getMessage());
		}
	}
}
?>
