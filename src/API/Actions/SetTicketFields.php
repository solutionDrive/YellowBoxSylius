<?php
/**
 * Created by PhpStorm.
 * User: vladi
 * Date: 08.02.17
 * Time: 12:47
 */

namespace solutionDrive\YellowBox\API\Actions;

class SetTicketFields extends AbstractAction
{
    protected $sRequestType = self::METHOD_PUT;
    protected $sRequestUrl = "issue/";
    protected $sTicket = null;
    protected $aTicketInformation = [];

    public function __construct(array $aTicketInformation)
    {
        $this->sTicket = $aTicketInformation["ticketKey"];
        unset($aTicketInformation['ticketKey']);
        $this->aTicketInformation = $aTicketInformation;
    }

    public function getArguments(): array
    {
        $aInfo = $this->aTicketInformation;
        $oObject = new \stdClass();

        foreach ($aInfo as $fieldName => $fieldValue) {
            $oObject->$fieldName = $fieldValue;
        }

        return [
            "json" => ["fields" => $oObject]
        ];
    }


    public function getRequestUrl(): string
    {
        return $this->sRequestUrl . $this->sTicket;
    }
}
