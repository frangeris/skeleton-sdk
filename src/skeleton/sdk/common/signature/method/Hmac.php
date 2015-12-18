<?php

namespace Skeleton\SDK\Common\Signature\Method;

use Skeleton\SDK\Common\Signature\ISignature;
use Skeleton\SDK\Common\Exception\InvalidKeysHmacException;
use Skeleton\SDK\Common\Client;

class Hmac implements ISignature
{
    use \Skeleton\SDK\Common\Factory\Manager;

    /**
     * Initialize the setting up of credentials using hmac (private/public).
     *
     * @param Skeleton\SDK\Common\Client $client   Client used for manage request
     * @param reference                  &$request Reference of the object to modify headers
     */
    public static function init(Client $client, &$request)
    {
        // Verification for required parameters
        $config = $client->getConfig();
        if (empty($config['public_key']) || empty($config['private_key'])) {
            throw new InvalidKeysHmacException('Both, public and private key are required for hmac authentication');
        }

        // Data to process
        switch ($request->getMethod()) {
            case 'POST':
                $data = count($request->getBody()->getFields()) ? json_encode($request->getBody()->getFields()) : null;
                break;
            case 'GET' :
                $data = count($request->getQuery()) ? json_encode((string)$request->getQuery()) : null;
                break;
            case 'PUT' :
                $data = $request->getBody()->getContents();
                break;
            case 'DELETE':
                $data = $request->getQuery();
                break;
        }

        // Setting the credentials
        $request->setHeaders([
            'X-PUBLIC-KEY' => $config['public_key'],
            'X-SIGNATURE' => base64_encode(hash_hmac('sha256', $data, $config['private_key'])),
            'X-NONCE' => time(),
        ]);
    }
}
