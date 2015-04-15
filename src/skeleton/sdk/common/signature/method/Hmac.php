<?php namespace Skeleton\SDK\Common\Signature\Method;

use Skeleton\SDK\Common\Signature\ISignature,
	Skeleton\SDK\Common\Exception\InvalidKeysHmacException,
	Skeleton\SDK\Common\Client
	;

class Hmac implements ISignature
{
	use \Skeleton\SDK\Common\Factory\Manager;

	/**
	 * Initialize the setting up of credentials using hmac (private/public)
	 * 
	 * @param Skeleton\SDK\Common\Client $client Client used for manage request
	 * @param reference &$request Reference of the object to modify headers
	 * @return void
	 */
	public static function init(Client $client, &$request)
	{
		print "hmac()\n";

		// Verification for required parameters
		$config = $client->getConfig();
		if (empty($config['public_key']) || empty($config['private_key']))
			throw new InvalidKeysHmacException('Both, public and private key are required for hmac authentication');

		// Setting the credentials
		$request->setHeaders([
			'X-PUBLIC-KEY' => $config['public_key'],
			'X-SIGNATURE' => base64_encode(hash_hmac('sha256', $request->__toString(), $config['private_key'])),
			'X-NONCE' => time()
		]);
	}
}