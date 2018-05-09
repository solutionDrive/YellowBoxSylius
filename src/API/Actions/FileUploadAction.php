<?php
/**
 * Created by PhpStorm.
 * User: vladi
 * Date: 08.02.17
 * Time: 12:47
 */

namespace solutionDrive\YellowBox\API\Actions;

use Symfony\Component\VarDumper\VarDumper;

class FileUploadAction extends AbstractAction
{
    protected $sRequestType = self::METHOD_POST;
    protected $sRequestUrl = 'issue/%s/attachments';
    protected $aArguments = [
      'headers' => [
          'X-Atlassian-Token'   => 'no-check',
      ]
    ];

    public function __construct($aArguments)
    {
        $this->sRequestUrl = sprintf($this->sRequestUrl, $aArguments['ticketKey']);
        foreach ($aArguments['files'] as $aFile) {
            $this->aArguments['multipart'][] =
                [
                    'name'      => 'file',
                    'contents'  => fopen($aFile['newPath'], 'r')
                ];
        }
    }
}
