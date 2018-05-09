<?php

/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 20.01.17
 * Time: 16:31
 */
namespace solutionDrive\YellowBox\API\Actions;

use Symfony\Component\VarDumper\VarDumper;

abstract class AbstractAction implements ActionInterface
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    protected $sRequestType = '';
    protected $sRequestUrl = '';
    protected $aArguments = [];

    public function getArguments() : array
    {
        return $this->aArguments;
    }

    public function getRequestUrl() : string
    {
        return $this->sRequestUrl;
    }

    public function getRequestType() : string
    {
        return $this->sRequestType;
    }

    public function __construct(array $aArguments)
    {
        if (isset($aArguments['require'])) {
            switch ($this->sRequestType) {
                case self::METHOD_POST:
                    $this->aArguments['json'] = $aArguments['require'];
                    break;
                case self::METHOD_GET:
                    $this->sRequestUrl .= '?';
                    foreach ($aArguments['require'] as $sClass => $aList) {
                        $this->sRequestUrl .= $sClass . '=' . implode(',', $aList);
                    }
                    break;
            }
        }
    }
}
