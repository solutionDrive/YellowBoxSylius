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
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class JiraConnector
{
    protected $sToken = null;
    protected $sApiUrl = null;
    protected $sPrivateKeyPath = null;
    protected $sPrivateKeyPassPhrase = null;

    public function __construct($sToken, $sPrivateKeyPassPhrase, $sJiraUrl, $sJiraApiUrl, $sJiraPrivateKey)
    {
        $this->sToken                = $sToken;
        $this->sPrivateKeyPath       = $sJiraPrivateKey;
        $this->sApiUrl               = $sJiraUrl . $sJiraApiUrl;
        $this->sPrivateKeyPassPhrase = $sPrivateKeyPassPhrase;
    }

    public function requestApi(ActionInterface $oAction)
    {
        $oClient    = $this->generateClient();
        $sReqestUrl = $this->sApiUrl . $oAction->getRequestUrl();
        $aArguments = $oAction->getArguments();
        $oRequest   = $oClient->request($oAction->getRequestType(), $sReqestUrl, $aArguments);
        return $oRequest;
    }

    protected function generateClient()
    {
        if ($sToken = $this->sToken) {
            $oStack = HandlerStack::create();

            $oMiddleware = new Oauth1([
                'consumer_key'           => 'yellowbox',
                'consumer_secret'        => 'yellow-box-secret',
                'token'                  => $sToken,
                'token_secret'           => '',
                'private_key_file'       => $this->sPrivateKeyPath,
                'private_key_passphrase' => $this->sPrivateKeyPassPhrase,
                'signature_method'       => Oauth1::SIGNATURE_METHOD_RSA,
            ]);

            $oStack->push($oMiddleware);

            $oClient = new Client([
                'handler' => $oStack,
                'auth' => 'oauth',
            ]);

            return $oClient;
        } else {
            throw new CustomUserMessageAuthenticationException('No Token for Jira API Call');
        }
    }
}
