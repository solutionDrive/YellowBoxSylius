<?php

/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 20.01.17
 * Time: 16:32
 */
namespace solutionDrive\YellowBox\API\Actions;

class SearchJiraTicketAction extends AbstractAction
{
    protected $sRequestType = self::METHOD_POST;
    protected $sTicketKey = '';
    protected $sRequestUrl = 'search';
    protected $aArguments = [
        'json' => [
            "jql"           => "key=",
            "startAt"       => 0,
            "maxResults"    => 1
        ]
    ];

    public function __construct(array $aParameter)
    {
        $this->sTicketKey = $aParameter['ticketKey'];
    }

    public function getArguments() : array
    {
        $this->aArguments['json']['jql'] .= $this->sTicketKey . ' order by key asc';
        return $this->aArguments;
    }
}
