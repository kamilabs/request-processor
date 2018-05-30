<?php


use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Artifact;
use PHPUnit\Framework\TestCase;

class ArtifactCollectionTest extends TestCase
{

    public function testCanBeConstructedWithCorrectArguments()
    {
        $artifacts = new ArtifactCollection([new Artifact('test', 'test_value')]);
        $this->assertInstanceOf(ArtifactCollection::class, $artifacts);
        $this->assertEquals(1, $artifacts->count());
    }

    public function testCanBeConstructedWithNoArguments()
    {
        $artifacts = new ArtifactCollection();
        $this->assertInstanceOf(ArtifactCollection::class, $artifacts);
    }

    public function testAdd()
    {
        $artifacts = new ArtifactCollection();
        $artifacts->add(new Artifact('test', 'test_value'));
        $this->assertEquals(1, $artifacts->count());
    }

    public function testAddNotAnArtifact()
    {
        $artifacts = new ArtifactCollection();
        $this->expectException(\InvalidArgumentException::class);
        $artifacts->add(['just_an_array']);
    }

    public function testGetRequested()
    {
        $artifacts = new ArtifactCollection([
            new Artifact('test', 'test_value'),
            new Artifact('another', 'another_value')
        ]);
        $requested = $artifacts->getRequested(['test', 'another']);
        $this->assertEquals(2, $requested->count());
    }

    public function testHasRequiredSuccess()
    {
        $artifacts = new ArtifactCollection([
            new Artifact('test', 'test_value'),
            new Artifact('another', 'another_value')
        ]);
        $this->assertTrue($artifacts->hasRequired(['test']));
    }

    public function testHasRequiredFail()
    {
        $artifacts = new ArtifactCollection([
            new Artifact('test', 'test_value'),
            new Artifact('another', 'another_value')
        ]);
        $this->assertFalse($artifacts->hasRequired(['not_existing']));
    }

    public function testSet()
    {
        $artifacts = new ArtifactCollection();
        $artifacts->set('test', new Artifact('test', 'test_value'));
        $this->assertEquals(1, $artifacts->count());
    }

    public function testSetNotAnArtifact()
    {
        $artifacts = new ArtifactCollection();
        $this->expectException(\InvalidArgumentException::class);
        $artifacts->set('cool_name', ['just_an_array']);
    }
}
