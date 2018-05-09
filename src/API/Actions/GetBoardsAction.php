<?php
/**
 * Created by PhpStorm.
 * User: vladi
 * Date: 24.02.17
 * Time: 10:24
 */

namespace solutionDrive\YellowBox\API\Actions;

class GetBoardsAction extends AbstractAction
{
    protected $sRequestType = self::METHOD_GET;
    protected $sRequestUrl ='../../../rest/agile/1.0/board?type=scrum';

    public function __construct(array $aArguments)
    {
        $this->aArguments = ['auth' => ['sultanov', base64_decode('VlNWMjI1MTk5NjU=')]];
    }
}
