<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API;

use GuzzleHttp\Client;

class JiraTokenGenerator
{
    /** @var string */
    protected $sJiraUrl = '';

    /** @var string */
    protected $sJira_token_request_url = '';

    /** @var string */
    protected $sJira_token_access_url = '';

    /** @var string */
    protected $sTokenAuthUrl = '';

    /** @var string */
    protected $aToken = '';

    /** @var Client */
    protected $client;

    public function __construct(
        Client $client,
        string $sJiraUrl,
        string $sJiraRequestUrl,
        string $sJiraAccessUrl,
        string $sTokenAuthUrl
    ) {
        $this->client = $client;
        $this->sJiraUrl = $sJiraUrl;
        $this->sJira_token_request_url = $sJiraRequestUrl;
        $this->sJira_token_access_url = $sJiraAccessUrl;
        $this->sTokenAuthUrl = $sTokenAuthUrl;
    }

    public function getAccessToken(string $sToken, string $sTokenSecret = ''): string
    {
        $sAccessTokenUrl = $this->sJiraUrl . $this->sJira_token_access_url;

        $oResponse = $this->client->request('POST', $sAccessTokenUrl);

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

        $oResponse = $this->client->request('POST', $sRequestTokenUrl);

        $sTokens = $oResponse->getBody()->getContents();

        if ('oauth_problem=nonce_used' === $sTokens) {
            throw new \Exception('There is already an API-Token configured!');
        }

        preg_match_all('/=(.+)&.+?=(.+)/', $sTokens, $aMatches);
        $aToken = [
            'token'         => $aMatches[1][0],
            'tokenSecret'   => $aMatches[2][0],
        ];

        $this->aToken = $aToken;
        return $this->sJiraUrl . $this->sTokenAuthUrl . $aToken['token'] . '&oauth_callback=' . $sRedirectUrl;
    }
}
