<?php

namespace Skeleton\SDK\Common\Signature;

use Skeleton\SDK\Common\Client;

interface ISignature
{
    public static function init(Client $client, &$request);
}
