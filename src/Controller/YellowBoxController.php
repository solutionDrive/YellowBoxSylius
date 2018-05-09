<?php
/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 08.05.18
 * Time: 11:09
 */

namespace solutionDrive\YellowBox\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;

class YellowBoxController extends Controller
{
    public function approveAction(Request $request)
    {
        $story = $request->request->get('story');
        $jira = $this->get('JiraService');
        $approveTransition = $this->getParameter('jira_transition_approve');

        $response = $jira->doTransition(
            [
                'ticketKey'  => $story,
                'transition' => $approveTransition
            ]);

        $success = false;
        if ($response->getStatusCode() === 200) {
            $success = true;
        }
        return $this->json(['success' => $success]);
    }

    public function declineAction(Request $request)
    {
        $story = $request->request->get('story');
        $declineReason = $request->request->get('decline_reason');
        $jira = $this->get('JiraService');
        $declineTransition = $this->getParameter('jira_transition_decline');
        $declineReasonField = $this->getParameter('jira_decline_reason_field');

        $jira->setTicketFields(
            [
                'ticketKey' => $story,
                $declineReasonField => $declineReason
            ]
        );

        $response = $jira->doTransition(
            [
                'ticketKey'  => $story,
                'transition' => $declineTransition
            ]);

        $success = false;
        $statuscode = $response->getStatusCode();
        if ($statuscode !== 404 && $statuscode !== 500 && $statuscode !== 401) {
            $success = true;
        }
        return $this->json(['success' => $success]);
    }

    public function getStorysAction()
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
}