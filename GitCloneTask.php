<?php
require_once dirname(__FILE__) . '/GitTask.php';

/**
 * Clones a git repository to a local directory.
 *
 * @author Zach Campbell <zacharydangercampbell@gmail.com>
 */
class GitCloneTask extends GitTask {
	private $_repo;
	private $_path;
	private $_onexisting;

	/**
	 * Sets the repository to clone.
	 */
	public function setRepo($repo) {
		$this->_repo = $repo;
	}

	/**
	 * Sets the target path for the cloned repository.
	 */
	public function setPath($path) {
		$this->_path = $path;
	}

	/**
	 * Sets the behaviour if path exists.
	 */
	public function setOnexisting($onexisting) {
		$this->_onexisting = $onexisting;
	}

	/**
	 * The main entry.
	 */
	public function main() {
		if(false == isset($this->_repo) || false == isset($this->_path)) {
			throw new BuildException("REPO and PATH must be set!");
		}

		if(true == file_exists($this->_path) ) {
			switch($this->_onexisting) {
				case 'replace': {
					if ( ! $this->recursiveRmDir($this->_path) ) {
						throw new BuildException("GitCloneTask Fail: PATH could not be deleted!");
					};
					break;
				}

				case 'ignore': {
					if ( file_exists($this->_path . '/.git/config') ) {
						// Ignore, just return.
						return;
					} else {
						throw new BuildException("GitCloneTask Fail: PATH already exists but does not look like a Git repository!");
					}
					break;
				}

				case 'fail': {
					throw new BuildException("PATH Already Exists");
				}

				default: {
					throw new BuildException("GitCloneTask Fail: PATH already exists!");
					break;
				}
			}
		}

		$git = $this->getGit();
		try {
			$git->createClone($this->_repo, false, $this->_path);
			$this->log("Repo successfully cloned.");
		} catch(VersionControl_Git_Exception $e) {
			throw new BuildException("Cloning failed: " . $e->getMessage());
		}
	}
}
