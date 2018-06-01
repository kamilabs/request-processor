<?php

namespace Kami\Component\RequestProcessor\Step;

use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\ProcessingException;

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

    /**
     * @param $name
     * @return mixed
     *
     * @throws ProcessingException
     */
    protected function getArtifact($name)
    {
        $artifact = $this->artifacts->get($name);
        if (!$artifact) {
            throw new ProcessingException(sprintf('You don\'t have "%s" artifact yet.', $name));
        }

        return $artifact->getValue();
    }
}