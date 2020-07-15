<?php
namespace Connfetti\IO\Base;

interface IWriter
{
    public function __construct($filename = null);
    public function setFile($filename);
    public function save();
    public function setContent($content);
}
