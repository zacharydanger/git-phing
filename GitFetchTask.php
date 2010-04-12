<?php
require_once 'GitTask.php';

/**
 * Perform a fetch in git.
 * @author Beau Simensen <simensen@gmail.com>
 */
class GitFetchTask extends GitTask {

    /**
     * Path to cloned repository
     * @var string
     */
    private $_path = null;
    
    /**
     * Tags?
     * @var bool
     */
    private $_tags = null;
    
    /**
     * Sets the target path for the cloned repository.
     */
    public function setPath($path) {
        $this->_path = $path;
    }
    
    /**
     * Sets the tags.
     */
    public function setTags($tags) {
    	if ( 'false' == strtolower($tags) or ! $tags ) {
    		$this->_tags = false;
    	} else {
    		$this->_tags = true;
    	}
    }
    
    /**
     * Main entry point.
     */
    public function main() {

        if(false == isset($this->_path)) {
            $this->log("GitFetchTask Fail: PATH must be set!\n");
            exit(1);
        }

        $dir = getcwd();
        chdir($this->_path);

        $cmd = $this->git_path . ' fetch';
        if ( $this->_tags ) {
        	$cmd .= ' --tags';
        }

        $this->log("Running " . $cmd);
        passthru($cmd, $return);
        $this->log("Return: " . $return);

        chdir($dir);

        if(intval($return) > 0) {
            if ( intval)
            $this->log("Git Fetch Failed.");
            exit(1);
        }

    }

}
?>