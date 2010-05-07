<?php
require_once 'phing/Project.php';
require_once 'phing/Task.php';
require_once 'VersionControl/Git.php';

/**
 * Base class for Git Tasks.
 *
 * @author Zach Campbell <zacharydangercampbell@gmail.com>
 */
class GitTask extends Task {
	/**
	 * Path to git executable.
	 */
	public $git_path = 'git';

	/**
	 * Main initialization, does nothing.
	 */
	public function init() { /* do nothing */ }

	/**
	 * Sets the VersionControl_Git object to use.
	 */
	public function setGit(VersionControl_Git $git) {
		$this->_git = $git;
	}

	/**
	 * Returns the VersionControl_Git object in use.
	 */
	public function getGit() {
		if(false == isset($this->_git)) {
			$this->_git = new VersionControl_Git();
		}
		return $this->_git;
	}

	/**
	 * Optionally set the path to git.
	 */
	public function setGitPath($git_path) {
		$this->getGit()->setGitCommandPath($git_path);
	}

	/**
	 * Main entry. Does nothing.
	 */
	public function main() { /* do nothing */ }
	
	/**
	 * Recursively delete a directory and its children
	 * @param string $dir Directory to delete
	 */
	protected function recursiveRmDir($dir) {
		if ( is_dir($dir) ) {
			$handle = opendir($dir);
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					if ( ! $this->recursiveRmDir($dir . '/' . $file) ) {
						return false;
					}
				}
			}
			closedir($handle);
			return rmdir($dir);
		} elseif ( is_file($dir) ) {
			return unlink($dir);
		} else {
			return false;
		}
	}
}
?>