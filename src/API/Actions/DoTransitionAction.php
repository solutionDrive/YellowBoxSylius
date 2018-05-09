<?php

/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 20.01.17
 * Time: 16:32
 */
namespace solutionDrive\YellowBox\API\Actions;

class DoTransitionAction extends AbstractAction
{
    const TEST_FAILED = 111;
    const TEST_SUCCESS = 121;

    protected $sRequestType = self::METHOD_POST;
    protected $sRequestUrl = 'issue/';
    protected $aArguments = [
        "json" => [
            'transition' => [
                'id' => 0
            ]
        ]
    ];

    public function __construct(array $sParameter)
    {
        $this->sRequestUrl .= $sParameter['ticketKey'] . '/transitions';
        $this->aArguments['json']['transition']['id'] = $sParameter['transition'];
    }
}
