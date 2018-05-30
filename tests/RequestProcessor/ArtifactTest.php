<?php


use Kami\Component\RequestProcessor\Artifact;
use PHPUnit\Framework\TestCase;

class ArtifactTest extends TestCase
{

    public function testCanBeConstructed()
    {
        $artifact = new Artifact('test', 'test_value');
        $this->assertInstanceOf(Artifact::class, $artifact);
    }

    public function testGetValue()
    {
        $artifact = new Artifact('test', 'test_value');
        $this->assertEquals('test_value', $artifact->getValue());
    }

    public function testGetName()
    {
        $artifact = new Artifact('test', 'test_value');
        $this->assertEquals('test', $artifact->getName());
    }
}
