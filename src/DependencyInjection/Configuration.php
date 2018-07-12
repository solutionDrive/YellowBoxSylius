<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('yellow_box');
        $rootNode
            ->children()
            ->variableNode('jira_token')->end()
            ->variableNode('jira_url')->end()
            ->variableNode('jira_api_url')->end()
            ->variableNode('jira_token_request_url')->end()
            ->variableNode('jira_token_auth_url')->end()
            ->variableNode('jira_token_access_url')->end()
            ->variableNode('jira_private_key')->end()
            ->variableNode('jira_private_key_passphrase')->end()
            ->variableNode('jira_projekt_key')->end()
            ->variableNode('jira_displayed_issue_status')->end()
            ->variableNode('jira_transition_approve')->end()
            ->variableNode('jira_transition_decline')->end()
            ->variableNode('jira_decline_reason_field')->end()
            ->variableNode('jira_tickets_url')->end()
            ->variableNode('jira_approve_url')->end()
            ->variableNode('jira_decline_url')->end()
            ->end();

        return $treeBuilder;
    }
}
