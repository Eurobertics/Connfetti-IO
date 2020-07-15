<?php
namespace Connfetti\IO\Reader;

use Connfetti\IO\Base\IOAbstract;
use Connfetti\IO\Base\IReader;

class CSVReader extends IOAbstract implements IReader
{
    private $csv_delimiter = ";";

    public function __construct($filename = null)
    {
        parent::__construct();
        $this->filename = $filename;
        if($filename != null) {
            try {
                $this->load();
            } catch(\Exception $e) {
                $this->filecontent = array();
            }
        }
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function setFile($filename)
    {
        $this->filename = $filename;
    }

    public function setDelimiter($delimiter)
    {
        $this->csv_delimiter = $delimiter;
    }

    public function getDelimiter()
    {
        return $this->csv_delimiter;
    }

    /** @throws \Exception */
    private function buildCSV()
    {
        if(!is_array($this->filecontent) || strpos($this->filecontent[(count($this->filecontent) - 1)], $this->csv_delimiter) === false) {
            throw new \Exception("No valid CSV data loaded from '".$this->filename."'!");
        }

        $buffer = array();
        for($i = 0; $i < count($this->filecontent); $i++) {
            if(is_array($this->filecontent[$i]) || substr(trim($this->filecontent[$i]), 0, 1) == '#') {
                continue;
            }
            $buffer[] = explode($this->csv_delimiter, $this->filecontent[$i]);
        }
        $this->filecontent = $buffer;
    }

    public function load()
    {
        try {
            $this->read();
        } catch(\Exception $e) {
            error_log($e->getMessage());
        }
        $this->buildCSV();
    }

    public function getContent()
    {
         return $this->filecontent;
    }
}
