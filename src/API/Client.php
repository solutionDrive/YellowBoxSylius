<?php declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class Client extends \GuzzleHttp\Client
{
    public function __construct(string $sToken, string $sPrivateKeyPath, string $sPrivateKeyPassphrase)
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

        parent::__construct([
            'handler' => $oStack,
            'auth' => 'oauth',
        ]);
    }
}
