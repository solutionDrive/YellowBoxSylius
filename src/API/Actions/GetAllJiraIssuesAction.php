<?php

/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 20.01.17
 * Time: 16:32
 */
namespace solutionDrive\YellowBox\API\Actions;

class GetAllJiraIssuesAction extends AbstractAction
{
    protected $sRequestType = self::METHOD_POST;
    protected $sRequestUrl = 'search';
    protected $aArguments = [
        'json' => [
            "jql"           => "
            (project=%s) AND 
            (status=testing OR status=internes\\ testen OR
             status=stage OR status=fertig\\ für\\ stage) order by key asc",
            "startAt"       => 0,
            "maxResults"    => 100,
            "fields"        => [
                    'summary'
                ]
        ]
    ];

    public function __construct(array $aParamteter = [])
    {
        $this->aArguments['json']['jql'] = sprintf($this->aArguments['json']['jql'], $aParamteter['projectKey']);
    }
}
