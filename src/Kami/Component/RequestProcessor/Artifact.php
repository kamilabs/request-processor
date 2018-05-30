<?php


namespace Kami\Component\RequestProcessor;

/**
 * Class Artifact
 *
 * @package Kami\Component\RequestProcessor
 */
final class Artifact
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var mixed
     */
    private $value;

    /**
     * Artifact constructor.
     * @param string $name
     *
     * @param $value
     */
    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}