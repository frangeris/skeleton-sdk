<?php

include(__DIR__ . '/../vendor/autoload.php');

use Skeleton\SDK\Common\Client,
	Skeleton\SDK\Providers\User\UserProvider;

$config = [
	'method' => 'hmac', 
	'public_key' => 'asdasdasd',
	'private_key' => 'zxzxzxzxzx',
	'base_url' => ['http://{domain}.mockable.io', ['domain' => 'demo4354589']],
];

// Setting up
$client = Client::getInstance()->setConfig($config);
$provider = new UserProvider($client);

// GET request
$provider->all();

// $provider->getById('<uuid>');

// POST
// $provider->create( IModelo $new_user );

// PUT
// $provider->update( IModelo $user_updated );

// DELETE
// $provider->delete( IModelo $provider | '<uuid>' );
