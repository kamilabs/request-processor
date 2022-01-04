<?php


namespace Kami\Component\RequestProcessor;

/**
 * Class Artifact
 *
 * @package Kami\Component\RequestProcessor
 */
final class Artifact
{
    private string $name;

    /**
     * @var mixed
     */
    private $value;

    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }
}