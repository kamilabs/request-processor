<?php


use Kami\Component\RequestProcessor\Step\AbstractStep;
use Symfony\Component\HttpFoundation\Request;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\Step\StepInterface;
use PHPUnit\Framework\TestCase;


class AbstractStepTest extends TestCase
{
    /**
     * @var AbstractStep
     */
    private $step;

    protected function setUp() : void
    {
        $this->step = new class extends AbstractStep {
            public function execute(Request $request): ArtifactCollection
            {
                return new ArtifactCollection();
            }

            public function getRequiredArtifacts(): array
            {
                return [];
            }

        };
    }

    public function testGetName()
    {
        $this->assertEquals(get_class($this->step), $this->step->getName());
    }

    public function testSetArtifacts()
    {
        $this->assertInstanceOf(StepInterface::class, $this->step->setArtifacts(
            new ArtifactCollection([new Artifact('test', 'test')])
        ));
    }

    public function testGetArtifact()
    {
        $this->step->setArtifacts(
            new ArtifactCollection([new Artifact('test', 'value')])
        );

        $reflection = new \ReflectionClass($this->step);
        $method = $reflection->getMethod('getArtifact');
        $method->setAccessible(true);

        $artifact = $method->invokeArgs($this->step, ['test']);
        $this->assertEquals('value', $artifact);
    }

    public function testGetNotExistingArtifact()
    {
        $this->step->setArtifacts(
            new ArtifactCollection([new Artifact('test', 'value')])
        );

        $reflection = new \ReflectionClass($this->step);
        $method = $reflection->getMethod('getArtifact');
        $method->setAccessible(true);
        $this->expectException(\Kami\Component\RequestProcessor\ProcessingException::class);
        $method->invokeArgs($this->step, ['not-existing']);

    }
}
