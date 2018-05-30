<?php


use Kami\Component\RequestProcessor\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{

    public function testCanBeConstructed()
    {
        $response = new Response('data', 200);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testToHttpResponse()
    {
        $response = new Response('data', 200);
        $httpResponse = $response->toHttpResponse();
        $this->assertInstanceOf(HttpResponse::class, $httpResponse);
        $this->assertEquals('data', $httpResponse->getContent());
        $this->assertEquals(200, $httpResponse->getStatusCode());
    }

    public function testGetData()
    {
        $response = new Response('data', 200);
        $this->assertEquals('data', $response->getData());
    }

    public function testGetStatus()
    {
        $response = new Response('data', 200);
        $this->assertEquals(200, $response->getStatus());
    }
}
