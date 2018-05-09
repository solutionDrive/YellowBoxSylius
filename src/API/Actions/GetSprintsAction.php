<?php
/**
 * Created by PhpStorm.
 * User: vladi
 * Date: 24.02.17
 * Time: 11:18
 */

namespace solutionDrive\YellowBox\API\Actions;

class GetSprintsAction extends AbstractAction
{
    protected $sRequestType = self::METHOD_GET;
    protected $sRequestUrl ='../../../rest/agile/1.0/board/%s/sprint';


    public function __construct(array $aArguments)
    {
        $this->aArguments = ['auth' => ['sultanov', base64_decode('VlNWMjI1MTk5NjU=')]];
        $this->sRequestUrl = sprintf($this->sRequestUrl, $aArguments['boardId']);
        parent::__construct($aArguments);
    }
}
