<?php
namespace Connfetti\IO\Base;

abstract class IOAbstract
{
    public static $VERSION = '0.2';

    protected $filename;
    protected $filecontent = array();

    public function __construct()
    {
    }

    public function __destruct()
    {
        $this->filename = "";
        $this->filecontent = array();
    }

    protected function read()
    {
        $fd = fopen($this->filename, 'r');
        if(!$fd) {
            throw new \Exception("Could not read file '".$this->filename."'!");
        }
        while(($buffer = fgets($fd)) !== false) {
            $this->filecontent[] = preg_replace("/\r|\n|\t/", '', $buffer);
        }
        fclose($fd);
    }

    protected function write()
    {
        $fd = fopen($this->filename, 'w');
        if(!$fd) {
            throw new \Exception("Could not write file!");
        }
        for($i = 0; $i < $this->filecontent; $i++) {
            $written = fwrite($fd, $this->filecontent[$i]);
            if($written === false) {
                break;
            }
        }
        fclose($fd);
    }
}