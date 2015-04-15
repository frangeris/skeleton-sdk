<?php

include(__DIR__ . '/../vendor/autoload.php');

use Skeleton\SDK\Common\Client,
	Skeleton\SDK\Providers\User\UserProvider;

$config = [
	'method' => 'hmac', // Signature to use
	'public_key' => 'asdasdasd',
	'private_key' => 'zxzxzxzxzx',
	'base_url' => ['http://api.{domain}.com', ['domain' => 'somedomain']],
];

// Setting up
$client = Client::getInstance()->setConfig($config);
$provider = new UserProvider($client);

// GET request
$provider->read();

// $provider->getById('<uuid>');

// POST
// $provider->create( IModelo $new_user );

// PUT
// $provider->update( IModelo $user_updated );

// DELETE
// $provider->delete( IModelo $provider | '<uuid>' );
