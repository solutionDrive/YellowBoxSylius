<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API;

use GuzzleHttp\Psr7\Response;
use solutionDrive\YellowBox\API\Actions\ActionInterface;

class JiraConnector
{
    /** @var ?string */
    protected $sApiUrl;

    /** @var ?Client */
    protected $client;

    public function __construct(Client $client, string $sJiraUrl, string $sJiraApiUrl)
    {
        $this->sApiUrl = $sJiraUrl . $sJiraApiUrl;
        $this->client = $client;
    }

    public function requestApi(ActionInterface $oAction): Response
    {
        $sRequestUrl = $this->sApiUrl . $oAction->getRequestUrl();
        $aArguments = $oAction->getArguments();
        $oRequest   = $this->client->request($oAction->getRequestType(), $sRequestUrl, $aArguments);
        return $oRequest;
    }
}
