<?php declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API\Actions;

class GetTicketTransitionsAction extends AbstractAction
{
    /** @var string */
    protected $sRequestType = self::METHOD_GET;

    /** @var string */
    protected $sRequestUrl = 'issue/';

    /**
     * @param string[] $aParameter
     */
    public function __construct(array $aParameter)
    {
        $this->sRequestUrl .= $aParameter['ticketKey'] . '/transitions';
    }
}
