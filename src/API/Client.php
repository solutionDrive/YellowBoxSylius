<?php
/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 16.05.18
 * Time: 17:24
 */

namespace solutionDrive\YellowBox\API;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class Client extends \GuzzleHttp\Client
{
    public function __construct($sToken, $sPrivateKeyPath, $sPrivateKeyPassphrase)
    {
        $oStack = HandlerStack::create();

        $oMiddleware = new Oauth1([
            'consumer_key'           => 'yellowbox',
            'consumer_secret'        => 'yellow-box-secret',
            'token'                  => $sToken,
            'token_secret'           => '',
            'private_key_file'       => $sPrivateKeyPath,
            'private_key_passphrase' => $sPrivateKeyPassphrase,
            'signature_method'       => Oauth1::SIGNATURE_METHOD_RSA,
        ]);

        $oStack->push($oMiddleware);

        parent::__construct(        [
            'handler' => $oStack,
            'auth' => 'oauth',
        ]);
    }
}