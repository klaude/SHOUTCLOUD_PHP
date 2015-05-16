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
                'base_url' => 'http://API.SHOUTCLOUD.IO',
                'defaults' => [
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                ],
            ]
        );
    }

    // CHUMP DON'T WANT THE HELP CHUMP DON'T GET THE HELP.
    if (empty($input)) {
        return $input;
    }

    // THIS IS WHY WE HAVE THE INTERNET.
    try {
        return $client->post(
            '/V1/SHOUT',
            ['body' => json_encode(['INPUT' => $input])]
        )->json()['OUTPUT'];
    } catch (\Exception $e) {
        throw new Exception($e->getMessage(), $e->getCode(), $e);
    }
}
