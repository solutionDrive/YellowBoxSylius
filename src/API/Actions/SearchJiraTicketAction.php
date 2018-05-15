<?php declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API\Actions;

class SearchJiraTicketAction extends AbstractAction
{
    /** @var string */
    protected $sRequestType = self::METHOD_POST;

    /** @var mixed|string */
    protected $sTicketKey = '';

    /** @var string */
    protected $sRequestUrl = 'search';

    /** @var string[] */
    protected $aArguments = [
        'json' => [
            'jql'           => 'key=',
            'startAt'       => 0,
            'maxResults'    => 1,
        ],
    ];

    /**
     * @param string[] $aParameter
     */
    public function __construct(array $aParameter)
    {
        $this->sTicketKey = $aParameter['ticketKey'];
    }

    /**
     * @return string[]
     */
    public function getArguments(): array
    {
        $this->aArguments['json']['jql'] .= $this->sTicketKey . ' order by key asc';
        return $this->aArguments;
    }
}
