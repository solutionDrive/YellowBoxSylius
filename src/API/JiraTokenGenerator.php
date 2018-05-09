<?php
/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 17.02.17
 * Time: 09:26
 */

namespace solutionDrive\YellowBox\API;

use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class JiraTokenGenerator
{
    protected $sJiraUrl;
    protected $sJira_token_request_url;
    protected $sJira_token_access_url;
    protected $sJira_private_key;
    protected $sTokenAuthUrl;
    protected $aToken;
    protected $sPrivateKeyPassPhrase;

    public function __construct($sPrivateKeyPassPhrase, $sJiraUrl, $sJiraRequestUrl, $sJiraAccessUrl, $sJiraPrivateKey, $sTokenAuthUrl)
    {
        $this->sJiraUrl = $sJiraUrl;
        $this->sJira_token_request_url = $sJiraRequestUrl;
        $this->sJira_token_access_url = $sJiraAccessUrl;
        $this->sJira_private_key = $sJiraPrivateKey;
        $this->sTokenAuthUrl = $sTokenAuthUrl;
        $this->sPrivateKeyPassPhrase = $sPrivateKeyPassPhrase;
    }


    public function getAccessToken($sToken, $sTokenSecret = '')
    {
        $sAccessTokenUrl = $this->sJiraUrl . $this->sJira_token_access_url;

        $client = $this->generateClient($sToken, $sTokenSecret);

        $oResponse = $client->request('POST', $sAccessTokenUrl);

        $sTokens = $oResponse->getBody()->getContents();

        preg_match_all('/=(.+?)&/', $sTokens, $aMatches);
        $aToken = [
            'token'         => $aMatches[1][0],
            'tokenSecret'   => $aMatches[1][1],
        ];

        return $aToken['token'];
    }

    public function getRequestToken($sRedirectUrl)
    {
        $sRequestTokenUrl = $this->sJiraUrl . $this->sJira_token_request_url;

        $client = $this->generateClient();

        $oResponse = $client->request('POST', $sRequestTokenUrl);

        $sTokens = $oResponse->getBody()->getContents();
        preg_match_all('/=(.+)&.+?=(.+)/', $sTokens, $aMatches);
        $aToken = [
            'token'         => $aMatches[1][0],
            'tokenSecret'   => $aMatches[2][0],
        ];

        $this->aToken = $aToken;
        return $this->sJiraUrl . $this->sTokenAuthUrl . $aToken['token'] . '&oauth_callback=' . $sRedirectUrl;
    }

    protected function generateClient($sToken = '', $sTokenSecret = '')
    {
        $stack = HandlerStack::create();

        $middleware = new Oauth1([
            'consumer_key'              => 'yellowbox',
            'consumer_secret'           => 'yellow-box-secret',
            'token'                     => $sToken,
            'token_secret'              => $sTokenSecret,
            'private_key_file'          => $this->sJira_private_key,
            'private_key_passphrase'    => $this->sPrivateKeyPassPhrase,
            'signature_method'          => Oauth1::SIGNATURE_METHOD_RSA,
        ]);

        $stack->push($middleware);

        $client = new Client([
            'handler' => $stack,
            'auth' => 'oauth',
        ]);
        return $client;
    }
}
