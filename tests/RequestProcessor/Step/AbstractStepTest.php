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

    public function setUp()
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
}
