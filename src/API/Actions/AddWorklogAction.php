<?php
/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 20.02.17
 * Time: 15:22
 */

namespace solutionDrive\YellowBox\API\Actions;

class AddWorklogAction extends AbstractAction
{
    protected $sRequestType = self::METHOD_POST;
    protected $sRequestUrl = 'issue/%s/worklog';

    public function __construct(array $aArguments)
    {
        $this->sRequestUrl = sprintf($this->sRequestUrl, $aArguments['ticketKey']);
        $this->aArguments['json'] = $aArguments['worklog'];
    }
}
