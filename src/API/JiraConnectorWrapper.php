<?php declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use solutionDrive\YellowBox\API\Actions\AbstractAction;

class JiraConnectorWrapper
{
    /** @var JiraConnector */
    protected $oJiraApi;

    /** @var string */
    protected $sNamespace = __NAMESPACE__ . '\\Actions\\';

    public function __construct(JiraConnector $oJiraApi)
    {
        $this->oJiraApi = $oJiraApi;
    }

    public function getActivityStream(): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetActivityStreamAction');
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function getAllJiraIssues(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetAllJiraIssuesAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function getAllProjects(): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetAllProjectsAction');
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function getJiraIssueById(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetJiraIssueByIdAction', $aParameter);
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function getProject(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetProjectAction', $aParameter);
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function fileUpload(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'FileUploadAction', $aParameter);
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function getTicketInfo(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetTicketInfoAction', $aParameter);
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function addWorklog(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'AddWorklogAction', $aParameter);
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function getTicketTransitions(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetTicketTransitionsAction', $aParameter);
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function doTransition(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'DoTransitionAction', $aParameter);
        return $this->executeAction($oAction);
    }

    public function getUser(): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetUserAction');
        return $this->executeAction($oAction);
    }

    public function removeAttachments(): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'RemoveAttachmentsAction');
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function searchJiraTicket(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'SearchJiraTicketAction', $aParameter);
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function searchJiraTickets(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'SearchJiraTicketsAction', $aParameter);
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function setTicketFields(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'SetTicketFields', $aParameter);
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function getBoards(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetBoardsAction', $aParameter);
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function getSprints(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetSprintsAction', $aParameter);
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function getSprintIssues(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetSprintIssuesAction', $aParameter);
        return $this->executeAction($oAction);
    }

    /**
     * @param string[] $aParameter
     */
    public function getVersion(array $aParameter = []): Response
    {
        $oAction = $this->generateAction($this->sNamespace . 'GetVersionAction', $aParameter);
        return $this->executeAction($oAction);
    }

    protected function executeAction(Actions\ActionInterface $oAction): Response
    {
        $oResponse = $this->oJiraApi->requestApi($oAction);
        return $oResponse;
    }

    /**
     * @param string[] $aParameter
     */
    protected function generateAction(string $action, array $aParameter = []): AbstractAction
    {
        return new $action($aParameter);
    }
}
