<?php

/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 20.01.17
 * Time: 16:32
 */
namespace solutionDrive\YellowBox\API\Actions;

class GetTicketTransitionsAction extends AbstractAction
{
    protected $sRequestType = self::METHOD_GET;
    protected $sRequestUrl = 'issue/';

    public function __construct(array $sParameter)
    {
        $this->sRequestUrl .= $sParameter['ticketKey'] . '/transitions';
    }
}
