<?php


namespace Kami\Component\RequestProcessor;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestProcessor
 *
 * @package Kami\Component\RequestProcessor
 */
class RequestProcessor implements RequestProcessorInterface
{
    /**
     * @var ArtifactCollection
     */
    protected $artifacts;

    /**
     * RequestProcessor constructor.
     */
    public function __construct()
    {
        $this->artifacts = new ArtifactCollection();
    }

    /**
     * @param AbstractStrategy $strategy
     * @param Request $request
     * @return Response
     *
     * @throws ProcessingException
     */
    public function executeStrategy(AbstractStrategy $strategy, Request $request) : Response
    {
        while ($step = $strategy->getNextStep()) {

            $step->setArtifacts($this->artifacts->getRequested($step->getRequiredArtifacts()));
            $artifacts = $step->execute($request);

            if ($artifacts instanceof ArtifactCollection) {
                $artifacts->forAll(function($key, Artifact $artifact) {
                    if ($this->artifacts->containsKey($key)) {
                        throw new ProcessingException(
                            sprintf('Collection already contains artifact with key %s', $key)
                        );
                    }
                    $this->addArtifact($artifact);
                });
            }
        }

        return new Response(
            $this->getArtifact('data')->getValue(),
            $this->getArtifact('status')->getValue()
        );
    }


    /**
     * @param Artifact $artifact
     *
     * @return RequestProcessorInterface
     */
    public function addArtifact(Artifact $artifact): RequestProcessorInterface
    {
        $this->artifacts->add($artifact);

        return $this;
    }

    /**
     * @param string $name
     * @throws ProcessingException
     *
     * @return Artifact
     */
    public function getArtifact(string $name) : Artifact
    {
        if (!$this->artifacts->containsKey($name)) {
            throw new ProcessingException(sprintf('You don\'t have "%s" artifact yet', $name));
        }

        return $this->artifacts->get($name);
    }
}