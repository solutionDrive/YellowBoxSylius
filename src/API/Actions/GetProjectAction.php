<?php
/**
 * Created by PhpStorm.
 * User: vladi
 * Date: 08.02.17
 * Time: 12:47
 */

namespace solutionDrive\YellowBox\API\Actions;

class GetProjectAction extends AbstractAction
{
    protected $sRequestType = self::METHOD_GET;
    protected $sRequestUrl = 'project/%s';

    public function __construct($aArguments)
    {
        $this->sRequestUrl = sprintf($this->sRequestUrl, $aArguments['project']);
    }
}
