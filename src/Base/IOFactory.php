<?php
namespace Connfetti\IO\Base;

abstract class IOFactory
{
    const FILE_CSV = 'CSV';
    const FILE_INI = 'INI';
    const FILE_PLAIN = 'Plain';

    private static $reader = array(
        'CSV' => \Connfetti\IO\Reader\CSVReader::class,
        'INI' => \Connfetti\IO\Reader\INIReader::class,
        'Plain' => \Connfetti\IO\Reader\PlainReader::class
    );

    private static $writer = array(
        'Plain' => \Connfetti\IO\Writer\PlainWriter::class
    );

    static public function createReader($reader, $filename = null)
    {
        if(!isset(self::$reader[$reader])) {
            throw new \Exception("Reader not found!");
        }

        $classname = self::$reader[$reader];
        return new $classname($filename);
    }

    static public function createWriter($writer, $filename = null)
    {
        if(!isset(self::$writer[$writer])) {
            throw new \Exception("Writer not fund!");
        }

        $classname = self::$writer[$writer];
        return new $classname($filename);
    }
}
