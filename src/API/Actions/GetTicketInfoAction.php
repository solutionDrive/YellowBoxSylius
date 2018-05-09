<?php

/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 20.01.17
 * Time: 16:32
 */
namespace solutionDrive\YellowBox\API\Actions;

class GetTicketInfoAction extends AbstractAction
{
    protected $sRequestType = self::METHOD_GET;
    protected $sRequestUrl = 'issue/%s';

    public function __construct(array $aParameter)
    {
        $this->sRequestUrl = sprintf($this->sRequestUrl, $aParameter['ticketKey']);
        parent::__construct($aParameter);
    }
}
