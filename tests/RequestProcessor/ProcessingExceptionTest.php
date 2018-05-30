<?php


use Kami\Component\RequestProcessor\ProcessingException;
use PHPUnit\Framework\TestCase;

class ProcessingExceptionTest extends TestCase
{
    public function testCanBeConstructed()
    {
        $exeption = new ProcessingException();
        $this->assertInstanceOf(ProcessingException::class, $exeption);
    }
}
