<?php

namespace SHOUTCLOUD\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Subscriber\Mock;
use PHPUnit_Framework_TestCase;

class SHOUTCLOUDTest extends PHPUnit_Framework_TestCase
{
    public function test_I_CAN_UPCASE()
    {
        $input = 'hello world';
        $responseBody = json_encode(['OUTPUT' => strtoupper($input)]);
        $responseSize = strlen($responseBody);
        $mock = new Mock([
            "HTTP/1.1 200 OK\r\nContent-Length: {$responseSize}\r\n\r\n{$responseBody}",
        ]);

        $client = new Client;
        $client->getEmitter()->attach($mock);

        $this->assertEquals(strtoupper($input), \SHOUTCLOUD\UPCASE($input, $client));
    }

    public function test_I_CAN_UPCASE_EMPTY_INPUT()
    {
        $this->assertNull(\SHOUTCLOUD\UPCASE());
    }

    public function test_ERRORS_WHILE_SHOUTING()
    {
        // FAKEY BAKEY 404.
        $mock = new Mock([
            new Response(404),
        ]);

        $client = new Client;
        $client->getEmitter()->attach($mock);

        $this->setExpectedException('SHOUTCLOUD\\Exception', 'CLIENT ERROR RESPONSE');
        \SHOUTCLOUD\UPCASE('hello', $client);
    }
}
