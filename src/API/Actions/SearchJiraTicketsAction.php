<?php

/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 20.01.17
 * Time: 16:32
 */
namespace solutionDrive\YellowBox\API\Actions;

class SearchJiraTicketsAction extends AbstractAction
{
    protected $sRequestType = self::METHOD_POST;
    protected $sJQL = '';
    protected $sRequestUrl = 'search';

    public function __construct(array $aParameter)
    {
        parent::__construct($aParameter);
        $this->aArguments['json']['jql'] = $aParameter['jql'];
    }
}
