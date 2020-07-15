<?php
namespace Connfetti\IO\Writer;

use Connfetti\IO\Base\IOAbstract;
use Connfetti\IO\Base\IWriter;

class PlainWriter extends IOAbstract implements IWriter
{
    public function __construct($filename = null)
    {
        parent::__construct();
        $this->filename = $filename;
    }

    public function setFile($filename)
    {
        $this->filename = $filename;
    }

    public function save()
    {
        $this->write();
    }

    public function setContent($content, $delimiter = "\n")
    {
        $contentvalid = false;
        if(is_array($content)) {
            $this->filecontent = $content;
            $contentvalid = true;
        }
        if(is_string($content)) {
            $this->filecontent = explode($delimiter, $content);
            $contentvalid = true;
        }

        return $contentvalid;
    }
}