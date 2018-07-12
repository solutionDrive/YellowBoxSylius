<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API\Actions;

class AddWorklogAction extends AbstractAction
{
    /** @var string */
    protected $sRequestType = self::METHOD_POST;

    /** @var string */
    protected $sRequestUrl = 'issue/%s/worklog';

    /**
     * @param string[] $aArguments
     */
    public function __construct(array $aArguments)
    {
        $this->sRequestUrl = sprintf($this->sRequestUrl, $aArguments['ticketKey']);
        $this->aArguments['json'] = $aArguments['worklog'];
    }
}
