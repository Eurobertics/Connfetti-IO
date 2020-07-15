<?php
namespace Connfetti\IO\Reader;

use Connfetti\IO\Base\IOAbstract;
use Connfetti\IO\Base\IReader;

class INIReader extends IOAbstract implements IReader
{
    public function __construct($filename = null)
    {
        parent::__construct();
        $this->filename = $filename;
        if($filename != null) {
            $this->load();
        }
    }

    public function setFile($filename)
    {
        $this->filename = $filename;
    }

    public function load()
    {
        try {
            $this->read();
            $this->buildINI();
        } catch(\Exception $e) {
        }
    }

    private function buildINI()
    {
        if(!is_array($this->filecontent) || strpos($this->filecontent[0], "=") === false) {
            throw new \Exception("No valid INI data loaded!");
        }

        $buffer = array();
        for($i = 0; $i < count($this->filecontent); $i++) {
            $buffer[] = explode("=", str_replace(' ', '', $this->filecontent[$i]));
        }
        $this->filecontent = $buffer;
    }

    public function getContent()
    {
        return $this->filecontent;
    }
}