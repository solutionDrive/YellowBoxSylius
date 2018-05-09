<?php
/**
 * Created by PhpStorm.
 * User: vladi
 * Date: 24.02.17
 * Time: 14:53
 */

namespace solutionDrive\YellowBox\API\Actions;

class GetSprintIssuesAction extends AbstractAction
{
    protected $sRequestType = self::METHOD_GET;
    protected $sRequestUrl = '../../../rest/agile/1.0/board/%s/sprint/%s/issue';

    public function __construct(array $aArguments)
    {
        $this->aArguments = ['auth' => ['sultanov', base64_decode('VlNWMjI1MTk5NjU=')]];
        $this->sRequestUrl = sprintf($this->sRequestUrl, $aArguments['boardId'], $aArguments['sprintId']);
        parent::__construct($aArguments);
    }
}
