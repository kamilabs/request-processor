<?php


namespace Kami\Component\RequestProcessor;


/**
 * Interface StrategyInterface
 *
 * @package Kami\Component\RequestProcessor
 */
interface StrategyInterface
{
    /**
     * @return array
     */
    public static function getSteps() : array;
}