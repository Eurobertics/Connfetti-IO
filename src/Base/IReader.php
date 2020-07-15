<?php
namespace Connfetti\IO\Base;

interface IReader
{
    public function __construct($filename = null);
    public function setFile($filename);
    public function load();
    public function getContent();
}