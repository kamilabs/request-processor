<?php

namespace Kami\Component\RequestProcessor\Step;

use Kami\Component\RequestProcessor\ArtifactCollection;
use Symfony\Component\HttpFoundation\Request;

/**
 * StepInterface
 *
 * @package Kami\ApiCoreBundle\RequestProcessor\Strategy
 */
interface StepInterface
{
    /**
     * @param Request $request
     *
     * @return ArtifactCollection
     */
    public function execute(Request $request) : ArtifactCollection;

    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @return array
     */
    public function getRequiredArtifacts() : array;

    /**
     * @param ArtifactCollection $artifacts
     *
     * @return StepInterface
     */
    public function setArtifacts(ArtifactCollection $artifacts) : StepInterface;
}