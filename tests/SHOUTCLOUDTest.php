<?php

namespace SHOUTCLOUD\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit_Framework_TestCase;

class SHOUTCLOUDTest extends PHPUnit_Framework_TestCase
{
    public function test_I_CAN_UPCASE()
    {
        $input = 'hello world';
        $responseBody = json_encode(['OUTPUT' => strtoupper($input)]);
        $responseSize = strlen($responseBody);
        $mockHandler = new MockHandler([
            new Response(200, ['Content-Length' => $responseSize], $responseBody),
        ]);

        $client = new Client(['handler' => HandlerStack::create($mockHandler)]);

        $this->assertEquals(strtoupper($input), \SHOUTCLOUD\UPCASE($input, $client));
    }

    public function test_I_CAN_UPCASE_EMPTY_INPUT()
    {
        $this->assertNull(\SHOUTCLOUD\UPCASE());
    }

    public function test_ERRORS_WHILE_SHOUTING()
    {
        // FAKEY BAKEY 404.
        $mockHandler = new MockHandler([
            new Response(404),
        ]);

        $client = new Client(['handler' => HandlerStack::create($mockHandler)]);

        $this->setExpectedException('SHOUTCLOUD\\Exception', 'CLIENT ERROR');
        \SHOUTCLOUD\UPCASE('hello', $client);
    }
}
