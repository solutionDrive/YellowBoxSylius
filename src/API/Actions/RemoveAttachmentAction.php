<?php
/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 15.02.17
 * Time: 10:08
 */

namespace solutionDrive\YellowBox\API\Actions;

class RemoveAttachmentAction extends AbstractAction
{
    protected $sRequestType = self::METHOD_DELETE;
    protected $sRequestUrl  = 'attachment/';

    public function __construct($sAttachmentId)
    {
        $this->sRequestUrl .= $sAttachmentId;
    }
}
