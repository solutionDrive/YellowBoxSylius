<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\Controller;

use \Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use GuzzleHttp\Psr7\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class YellowBoxController extends Controller
{
    public function approveAction(Request $request): SymfonyResponse
    {
        $story = $request->request->get('story');
        $jira = $this->get('JiraService');
        $approveTransition = $this->getParameter('jira_transition_approve');

        $response = $jira->doTransition(
            [
                'ticketKey'  => $story,
                'transition' => $approveTransition,
            ]
        );

        $success = $this->requestSuccessfull($response);
        return $this->json(['success' => $success]);
    }

    public function declineAction(Request $request): SymfonyResponse
    {
        $story  = $request->request->get('story');
        $jira   = $this->get('JiraService');
        $declineReason = $request->request->get('decline_reason');
        $declineTransition  = $this->getParameter('jira_transition_decline');
        $declineReasonField = $this->getParameter('jira_decline_reason_field');

        $jira->setTicketFields(
            [
                'ticketKey' => $story,
                $declineReasonField => $declineReason,
            ]
        );

        $response = $jira->doTransition(
            [
                'ticketKey'  => $story,
                'transition' => $declineTransition,
            ]
        );

        $success = $this->requestSuccessfull($response);
        return $this->json(['success' => $success]);
    }

    public function getStorysAction(): SymfonyResponse
    {
        $jira = $this->get('JiraService');
        $projekt = $this->getParameter('jira_projekt_key');
        $currentState = $this->getParameter('jira_displayed_issue_status');
        $response = $jira->searchJiraTickets([
            'jql' => "project = $projekt AND status = '$currentState'",
        ]);

        $json = \json_decode($response->getBody()->getContents(), true);
        return $this->json($json['issues']);
    }

    private function requestSuccessfull(Response $response): bool
    {
        $statusCode = $response->getStatusCode();
        if ($statusCode < 300 && $statusCode > 100) {
            return true;
        }
        return false;
    }
}
