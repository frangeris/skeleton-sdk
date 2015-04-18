<?php

include(__DIR__ . '/../vendor/autoload.php');

use Skeleton\SDK\Common\Client,
	Skeleton\SDK\Providers\User\UserProvider;

$config = [
	'method' => 'hmac', // Signature to use
	'public_key' => 'xxxxxxxxxxx',
	'private_key' => 'xxxxxxxxxxx',
	'base_url' => ['http://{identifier}.mockable.io', ['identifier' => 'demo4354589']],
];

// Setting up
$client = Client::getInstance()->setConfig($config);
$provider = new UserProvider($client);

// GET request
// $provider->read();

// $provider->getById('<uuid>');

// POST
$user = new \stdClass();
$user->email = 'test@test.com';
print $provider->create($user);

// PUT
// $provider->update( IModelo $user_updated );

// DELETE
// $provider->delete( IModelo $provider | '<uuid>' );
