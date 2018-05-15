<?php declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use solutionDrive\YellowBox\API\Actions\ActionInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class JiraConnector
{
    /** @var ?string */
    protected $sToken = null;

    /** @var ?string */
    protected $sApiUrl = null;

    /** @var ?string */
    protected $sPrivateKeyPath = null;

    /** @var ?string */
    protected $sPrivateKeyPassPhrase = null;

    public function __construct(
        string $sToken,
        string $sPrivateKeyPassPhrase,
        string $sJiraUrl,
        string $sJiraApiUrl,
        string $sJiraPrivateKey
    ) {
        $this->sToken                = $sToken;
        $this->sPrivateKeyPath       = $sJiraPrivateKey;
        $this->sApiUrl               = $sJiraUrl . $sJiraApiUrl;
        $this->sPrivateKeyPassPhrase = $sPrivateKeyPassPhrase;
    }

    public function requestApi(ActionInterface $oAction): Response
    {
        $oClient    = $this->generateClient();
        $sReqestUrl = $this->sApiUrl . $oAction->getRequestUrl();
        $aArguments = $oAction->getArguments();
        $oRequest   = $oClient->request($oAction->getRequestType(), $sReqestUrl, $aArguments);
        return $oRequest;
    }

    protected function generateClient(): Client
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
