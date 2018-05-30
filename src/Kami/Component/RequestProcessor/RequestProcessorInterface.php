<?php

namespace Kami\Component\RequestProcessor;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface RequestProcessorInterface
 *
 * @package Kami\Component\RequestProcessor
 */
interface RequestProcessorInterface
{
    /**
     * @param StrategyInterface $strategy
     * @param Request $request
     *
     * @return Response
     */
    public function executeStrategy(StrategyInterface $strategy, Request $request) : Response;

    /**
     * @param Artifact $artifact
     *
     * @return RequestProcessorInterface
     */
    public function addArtifact(Artifact $artifact) : RequestProcessorInterface;

    /**
     * @param string $name
     *
     * @return Artifact
     */
    public function getArtifact(string $name) : Artifact;
}