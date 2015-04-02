<?php namespace Skeleton\SDK\Common\Signature\Method;

use Skeleton\SDK\Common\Signature\ISignature,
	Skeleton\SDK\Common\Exception\InvalidKeysHmacException
	;

class Hmac implements ISignature
{
	use \Skeleton\SDK\Common\Factory\Manager;

	public static function init($client)
	{
		print "hmac()\n";

		$params = $client->getCredentials();
		if (empty($params['public_key']) || empty($params['private_key']))
			throw new InvalidKeysHmacException('Both, public and private key are required for hmac authentication');

		/*
			Set headers to request
			- X-PUBLIC-KEY
			- X-SIGNATURE
			- X-NONCE
		 */




	}
}