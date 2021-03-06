<?php


namespace Kami\Component\RequestProcessor;


use Kami\Component\RequestProcessor\Step\StepInterface;

abstract class AbstractStrategy implements StrategyInterface
{
    protected $steps;

    public function __construct(array $steps)
    {
        $this->steps = new \SplQueue();
        foreach ($steps as $step) {
            $this->addStep($step);
        }
    }

    public function getNextStep(): ?StepInterface
    {
        if ($this->steps->count() == 0) {
            return null;
        }

        return $this->steps->dequeue();
    }

    public function addStep(StepInterface $step): StrategyInterface
    {
        $this->steps->enqueue($step);

        return $this;
    }
}