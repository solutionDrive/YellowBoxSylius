<?php
/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 06.02.17
 * Time: 15:40
 */

namespace solutionDrive\YellowBox\API;

use solutionDrive\YellowBox\API\Actions\ActionInterface;
use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class JiraConnector extends Bundle
{
    protected $sEnv = null;
    protected $sOAuthToken = null;
    protected $sOAuthTokenSecret = null;
    protected $token = null;
    protected $sApiUrl = null;
    protected $sPrivateKeyPath = null;
    protected $sPrivateKeyPassPhrase = null;

    public function __construct($token, $sPrivateKeyPassPhrase, $sJiraUrl, $sJiraApiUrl, $sJiraPrivateKey)
    {
        $this->token = $token;
        $this->sPrivateKeyPath = $sJiraPrivateKey;
        $this->sApiUrl = $sJiraUrl . $sJiraApiUrl;
        $this->sPrivateKeyPassPhrase = $sPrivateKeyPassPhrase;
    }

    public function requestApi(ActionInterface $oAction)
    {
        $oClient = $this->generateClient();
        $sReqestUrl = $this->sApiUrl . $oAction->getRequestUrl();
        $aArguments = $oAction->getArguments();
        $oRequest = $oClient->request($oAction->getRequestType(), $sReqestUrl, $aArguments);
        return $oRequest;
    }

    protected function generateClient()
    {
        if ($sToken = $this->token) {
            $stack = HandlerStack::create();

            $middleware = new Oauth1([
                'consumer_key'           => 'yellowbox',
                'consumer_secret'        => 'yellow-box-secret',
                'token'                  => $sToken,
                'token_secret'           => '',
                'private_key_file'       => $this->sPrivateKeyPath,
                'private_key_passphrase' => $this->sPrivateKeyPassPhrase,
                'signature_method'       => Oauth1::SIGNATURE_METHOD_RSA,
            ]);

            $stack->push($middleware);

            $client = new Client([
                'handler' => $stack,
                'auth' => 'oauth',
            ]);

            return $client;
        } else {
            throw new CustomUserMessageAuthenticationException('No No Token');
        }
    }
}
