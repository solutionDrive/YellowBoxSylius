<?php declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class JiraTokenGenerator
{
    /** @var string */
    protected $sJiraUrl = '';

    /** @var string */
    protected $sJira_token_request_url = '';

    /** @var string */
    protected $sJira_token_access_url = '';

    /** @var string */
    protected $sJira_private_key = '';

    /** @var string */
    protected $sTokenAuthUrl = '';

    /** @var string */
    protected $aToken = '';

    /** @var string */
    protected $sPrivateKeyPassPhrase = '';

    public function __construct(
        string $sPrivateKeyPassPhrase,
        string $sJiraUrl,
        string $sJiraRequestUrl,
        string $sJiraAccessUrl,
        string $sJiraPrivateKey,
        string $sTokenAuthUrl
    ) {
        $this->sJiraUrl = $sJiraUrl;
        $this->sJira_token_request_url = $sJiraRequestUrl;
        $this->sJira_token_access_url = $sJiraAccessUrl;
        $this->sJira_private_key = $sJiraPrivateKey;
        $this->sTokenAuthUrl = $sTokenAuthUrl;
        $this->sPrivateKeyPassPhrase = $sPrivateKeyPassPhrase;
    }

    public function getAccessToken(string $sToken, string $sTokenSecret = ''): string
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

    public function getRequestToken(string $sRedirectUrl): string
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

    protected function generateClient(string $sToken = '', string $sTokenSecret = ''): Client
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
