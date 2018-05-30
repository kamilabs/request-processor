<?php

use Kami\Component\RequestProcessor\RequestProcessor;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\Step\StepInterface;
use Kami\Component\RequestProcessor\AbstractStrategy;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Response;
use Kami\Component\RequestProcessor\ProcessingException;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

class RequestProcessorTest extends TestCase
{

    public function testCanBeConstructed()
    {
        $requestProcessor = new RequestProcessor();
        $this->assertInstanceOf(RequestProcessor::class, $requestProcessor);
    }

    public function testAddArtifact()
    {
        $requestProcessor = new RequestProcessor();
        $requestProcessor->addArtifact(new Artifact('test', 'test_value'));
        $reflection = new ReflectionClass(RequestProcessor::class);
        $property = $reflection->getProperty('artifacts');
        $property->setAccessible(true);
        $this->assertEquals(1, $property->getValue($requestProcessor)->count());
    }

    public function testExecuteStrategy()
    {
        $requestProcessor = new RequestProcessor();
        $response = $requestProcessor->executeStrategy($this->createStrategyMock(), new Request());
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('data', $response->getData());
        $this->assertEquals(200, $response->getStatus());
    }

    public function testExecuteStrategyWithDublicatedArtifacts()
    {
        $requestProcessor = new RequestProcessor();
        $this->expectException(ProcessingException::class);
        $requestProcessor->executeStrategy($this->createDublicatingStrategyMock(), new Request());
    }

    public function testGetExistingArtifact()
    {
        $requestProcessor = new RequestProcessor();
        $requestProcessor->addArtifact(new Artifact('test', 'test_artifact'));

        $artifact = $requestProcessor->getArtifact('test');
        $this->assertInstanceOf(Artifact::class, $artifact);
    }

    public function testGetNotExistingArtifact()
    {
        $requestProcessor = new RequestProcessor();
        $requestProcessor->addArtifact(new Artifact('test', 'test_artifact'));
        $this->expectException(\Kami\Component\RequestProcessor\ProcessingException::class);
        $requestProcessor->getArtifact('not_existing');
    }

    private function createStepMock(ArtifactCollection $artifacts)
    {
        $step = $this->createMock(StepInterface::class);
        $step->expects($this->any())->method('execute')
            ->willReturn($artifacts);

        return $step;

    }

    private function createStrategyMock()
    {
        $strategy = $this->createMock(AbstractStrategy::class);
        $strategy->expects($this->exactly(3))
            ->method('getNextStep')
            ->willReturnOnConsecutiveCalls(
                $this->createStepMock(new ArtifactCollection([new Artifact('data', 'data')])),
                $this->createStepMock(new ArtifactCollection([new Artifact('status', 200)])),
                null
            );

        return $strategy;
    }


    private function createDublicatingStrategyMock()
    {
        $strategy = $this->createMock(AbstractStrategy::class);
        $strategy->expects($this->exactly(2))
            ->method('getNextStep')
            ->willReturnOnConsecutiveCalls(
                $this->createStepMock(new ArtifactCollection([new Artifact('data', 'data')])),
                $this->createStepMock(new ArtifactCollection([new Artifact('data', 'data')]))
            );

        return $strategy;
    }
}
