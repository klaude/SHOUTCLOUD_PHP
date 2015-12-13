<?php

namespace SHOUTCLOUD;

use GuzzleHttp\Client;

/**
 * CAPS LOCK IS CRUISE CONTROL FOR COOL.
 *
 * @throws \SHOUTCLOUD\Exception IF THE SHOUTCLOUD API BROKE
 * @param string $input
 * @param Client $client
 * @return string
 */
function UPCASE($input = null, Client $client = null)
{
    // BUILD AN HTTP CLIENT IF ONE WASN'T PROVIDED FOR TESTING.
    if (is_null($client)) {
        $client = new Client(
            [
                'base_uri' => 'http://API.SHOUTCLOUD.IO',
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]
        );
    }

    // CHUMP DON'T WANT THE HELP CHUMP DON'T GET THE HELP.
    if (empty($input)) {
        return $input;
    }

    $options = ['body' => json_encode(['INPUT' => $input])];

    // THIS IS WHY WE HAVE THE INTERNET.
    try {
        $response = $client->request('post', '/V1/SHOUT', $options)->getBody()->getContents();
    } catch (\Exception $e) {
        throw new Exception($e->getMessage(), $e->getCode(), $e);
    }

    return json_decode($response)->OUTPUT;
}
