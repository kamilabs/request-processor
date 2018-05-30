<?php


use Kami\Component\RequestProcessor\AbstractStrategy;
use Kami\Component\RequestProcessor\Step\StepInterface;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use PHPUnit\Framework\TestCase;

class AbstractStrategyTest extends TestCase
{
    /**
     * @var AbstractStrategy
     */
    private $strategy;

    public function setUp()
    {
        $step1 = $this->createMock(StepInterface::class);
        $step2 = $this->createMock(StepInterface::class);

        $this->strategy = new class extends AbstractStrategy {

            /**
             * @var array
             */
            protected static $testSteps = [];

            /**
             * @param array $steps
             */
            public static function addTestSteps(array $steps)
            {
                static::$testSteps = $steps;
            }

            /**
             * @return array
             */
            public static function getSteps(): array
            {
                return static::$testSteps;
            }
        };

        $this->strategy::addTestSteps([$step1, $step2]);
    }

    public function testAddStep()
    {
        $step = $this->createMock(StepInterface::class);
        $this->strategy->addStep($step);
        $this->assertEquals($step, $this->strategy->getNextStep());
    }


    public function testGetNextStep()
    {
        $step1 = $this->createMock(StepInterface::class);
        $step2 = $this->createMock(AbstractStep::class);

        $this->strategy->addStep($step1);
        $this->strategy->addStep($step2);

        $this->strategy->getNextStep();
        $this->strategy->getNextStep();

        $this->assertEquals($step1, $this->strategy->getNextStep());
        $this->assertEquals($step2, $this->strategy->getNextStep());
        $this->assertEquals(null, $this->strategy->getNextStep());
    }
}
