<?php
namespace Connfetti\IO\Reader;

use Connfetti\IO\Base\IOAbstract;
use Connfetti\IO\Base\IReader;

class PlainReader extends IOAbstract implements IReader
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
        $this->read();
    }

    public function getContent($asArray = false, string $glue = "\n")
    {
        if($asArray) {
            return $this->filecontent;
        }
        return implode($glue, $this->filecontent);
    }
}
