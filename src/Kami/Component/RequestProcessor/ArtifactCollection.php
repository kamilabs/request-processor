<?php


namespace Kami\Component\RequestProcessor;

use Closure;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ArtifactCollection
 *
 * @package Kami\Component\RequestProcessor
 */
class ArtifactCollection extends ArrayCollection
{

    public function __construct(array $elements = [])
    {
        parent::__construct([]);

        foreach ($elements as $element) {
            $this->set($element->getName(), $element);
        }
    }

    /**
     * @param $element
     *
     * @return void
     */
    public function add($element) : void
    {

        if (!$element instanceof Artifact) {
            throw new \InvalidArgumentException('You can add only Artifact to ArtifactCollection');
        }

        $this->set($element->getName(), $element);
        return;
    }

    public function set($key, $value) : void
    {
        if (!$value instanceof Artifact) {
            throw new \InvalidArgumentException('You can add only Artifact to ArtifactCollection');
        }
        parent::set($key, $value);
    }

    /**
     * @param array $names
     *
     * @return bool
     */
    public function hasRequired(array $names) : bool
    {
        foreach ($names as $name) {
            if (!$this->containsKey($name)) {

                return false;
            }
        }

        return true;
    }

    /**
     * @param array $requestedArtifacts
     *
     * @throws ProcessingException
     *
     * @return ArtifactCollection
     */
    public function getRequested(array $requestedArtifacts) : ArtifactCollection
    {
        $requested = [];
        foreach ($requestedArtifacts as $requestedArtifact) {
            $artifact = $this->get($requestedArtifact);
            if (!$artifact) {
                throw new ProcessingException(
                    sprintf('There is no artifact with name "%s" yet', $requestedArtifact)
                );
            }
            $requested[] = $artifact;
        }

        return new ArtifactCollection($requested);
    }

}