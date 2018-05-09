<?php
/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 17.02.17
 * Time: 09:06
 */

namespace solutionDrive\YellowBox\API;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use solutionDrive\YellowBox\API\Actions;

class JiraConnectorWrapper
{
    protected $oJiraApi = null;
    protected $sNamespace = __NAMESPACE__ . '\\Actions\\';
    public function __construct(JiraConnector $oJiraApi)
    {
        $this->oJiraApi = $oJiraApi;
    }

    public function getActivityStream()
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetActivityStreamAction');
        return $this->executeAction($oAction);
    }

    public function getAllJiraIssues(array $aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetAllJiraIssuesAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function getAllProjects()
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetAllProjectsAction');
        return $this->executeAction($oAction);
    }

    public function getJiraIssueById(array $aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetJiraIssueByIdAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function getProject(array $aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetProjectAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function fileUpload(array $aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'FileUploadAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function getTicketInfo(array $aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetTicketInfoAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function addWorklog(array $aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'AddWorklogAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function getTicketTransitions(array $aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetTicketTransitionsAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function doTransition(array $aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'DoTransitionAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function getUser()
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetUserAction');
        return $this->executeAction($oAction);
    }

    public function removeAttachments()
    {
        $oAction = $this->generateAction($this->sNamespace . 'RemoveAttachmentsAction');
        return $this->executeAction($oAction);
    }

    public function searchJiraTicket($aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'SearchJiraTicketAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function searchJiraTickets($aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'SearchJiraTicketsAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function setTicketFields($aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'SetTicketFields', $aParameter);
        return $this->executeAction($oAction);
    }

    public function getBoards($aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetBoardsAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function getSprints($aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetSprintsAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function getSprintIssues($aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetSprintIssuesAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function getVersion($aParameter = [])
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetVersionAction', $aParameter);
        return $this->executeAction($oAction);
    }

    protected function executeAction(Actions\ActionInterface $oAction) : Response
    {
        try {
            $oResponse = $this->oJiraApi->requestApi($oAction);
        } catch (RequestException $oException) {
            $oResponse = $oException->getResponse();
        }
        return $oResponse;
    }

    protected function generateAction($action, $aParameter = [])
    {
        return new $action($aParameter);
    }
}
