<?php


namespace Kami\Component\RequestProcessor;

use Symfony\Component\HttpFoundation\Response as HttpResponse;

final class Response
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var int
     */
    protected $status;

    /**
     * Response constructor.
     *
     * @param $data
     * @param int $status
     */
    public function __construct($data, int $status)
    {
        $this->data = $data;
        $this->status = $status;
    }

    /**
     * @param iterable $headers
     *
     * @return HttpResponse
     */
    public function toHttpResponse() : HttpResponse
    {
        return new HttpResponse(
            $this->data,
            $this->status
        );
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

}