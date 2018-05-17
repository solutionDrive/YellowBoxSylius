<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API\Actions;

class SearchJiraTicketsAction extends AbstractAction
{
    /** @var string */
    protected $sRequestType = self::METHOD_POST;

    /** @var string */
    protected $sJQL = '';

    /** @var string */
    protected $sRequestUrl = 'search';

    /**
     * @param string[] $aParameter
     */
    public function __construct(array $aParameter)
    {
        parent::__construct($aParameter);
        $this->aArguments['json']['jql'] = $aParameter['jql'];
    }
}
