<?php


namespace Kami\Component\RequestProcessor;
use Kami\Component\RequestProcessor\Step\StepInterface;


/**
 * Interface StrategyInterface
 *
 * @package Kami\Component\RequestProcessor
 */
interface StrategyInterface
{
    /**
     * StrategyInterface constructor.
     *
     * @param array $steps
     */
    public function __construct(array $steps);

    /**
     * @return StepInterface|null
     */
    public function getNextStep(): ?StepInterface;
}