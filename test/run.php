<?php

include('vendor/autoload.php');

use Skeleton\SDK\Common\Client,
	Skeleton\SDK\Providers\User\UserProvider;

$config = [
	'method' => 'hmac', 
	'public_key' => 'asdasdasd',
	'private_key' => 'zxzxzxzxzx',
];

$client = Client::getInstance()->setCredentials($config);

$provider = new UserProvider($client);

// GET
$provider->all();

// $provider->getById('<uuid>');

// POST
// $provider->create( IModelo $new_user );

// PUT
// $provider->update( IModelo $user_updated );

// DELETE
// $provider->delete( IModelo $provider | '<uuid>' );
