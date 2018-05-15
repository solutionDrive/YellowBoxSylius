<?php declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API\Actions;

class GetBoardsAction extends AbstractAction
{
    /** @var string */
    protected $sRequestType = self::METHOD_GET;

    /** @var string */
    protected $sRequestUrl ='../../../rest/agile/1.0/board?type=scrum';

    /**
     * @param string[] $aArguments
     */
    public function __construct(array $aArguments)
    {
        $this->aArguments = ['auth' => ['sultanov', base64_decode('VlNWMjI1MTk5NjU=')]];
    }
}
