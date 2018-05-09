<?php
/**
 * Created by PhpStorm.
 * User: vladi
 * Date: 08.02.17
 * Time: 12:47
 */

namespace solutionDrive\YellowBox\API\Actions;

class GetUserAction extends AbstractAction
{
    protected $sRequestType = self::METHOD_GET;
    protected $sRequestUrl = 'myself';
}
