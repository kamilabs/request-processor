<?php

namespace Kami\Component\RequestProcessor\Step;

use Kami\Component\RequestProcessor\ArtifactCollection;

/**
 * Class AbstractStep
 *
 * @package Kami\ApiCoreBundle\RequestProcessor\Step
 */
abstract class AbstractStep implements StepInterface
{

    /**
     * @var ArtifactCollection
     */
    protected $artifacts;

    /**
     * @return string
     */
    public function getName() : string
    {
        return get_class($this);
    }

    /**
     * @param ArtifactCollection $artifacts
     *
     * @return StepInterface
     */
    public function setArtifacts(ArtifactCollection $artifacts): StepInterface
    {
        $this->artifacts = $artifacts;

        return $this;
    }
}