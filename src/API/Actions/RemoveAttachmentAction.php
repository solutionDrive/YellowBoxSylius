<?php declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API\Actions;

class RemoveAttachmentAction extends AbstractAction
{
    /** @var string */
    protected $sRequestType = self::METHOD_DELETE;

    /** @var string */
    protected $sRequestUrl  = 'attachment/';

    public function __construct(string $sAttachmentId)
    {
        $this->sRequestUrl .= $sAttachmentId;
    }
}
