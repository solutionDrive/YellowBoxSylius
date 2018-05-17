<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API\Actions;

abstract class AbstractAction implements ActionInterface
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    /** @var string */
    protected $sRequestType = '';

    /** @var string */
    protected $sRequestUrl = '';

    /** @var string[] */
    protected $aArguments = [];

    /**
     * @return string[]
     */
    public function getArguments(): array
    {
        return $this->aArguments;
    }

    public function getRequestUrl(): string
    {
        return $this->sRequestUrl;
    }

    public function getRequestType(): string
    {
        return $this->sRequestType;
    }

    /**
     * @param string[] $aArguments
     */
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
