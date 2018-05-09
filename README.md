#Yellow-box

## Installation

1. Run `composer require solutiondrive/yellow-box`.

2. Add following configuration to your `config.yml` and replace the values with yours
        
        yellow_box:
          jira_token: <REST-API-TOKEN> #generated in step 3
          jira_url: <your jira server>
          jira_api_url: /rest/api/2/
          jira_token_request_url: /plugins/servlet/oauth/request-token
          jira_token_auth_url: /plugins/servlet/oauth/authorize?oauth_token=
          jira_token_access_url: /plugins/servlet/oauth/access-token
          jira_private_key: <path to your pcks8 private key>
          jira_private_key_passphrase: <Your private key passphrase>
          jira_projekt_key: <The Key of the Projekt the issues are in>
          jira_displayed_issue_status: <The state of the issues to display>
          jira_transition_approve: <transition id for approving>
          jira_transition_decline: <transition id for declining>
          jira_decline_reason_field: <the field to write the decline reason in>
3. Go to the shop which this plugin is installed on and open 
        
        <your protocoll>://<your-shop>/solutiondrive/yellowbox/generate_token
        
    and authenticate with your the jira account that the yellowbox should use. Now there should be the REST-API-Token you can insert into your config. 

## Usage

### Running plugin tests

  - Behat (non-JS scenarios)

    ```bash
    $ bin/behat --tags="~@javascript"
    ```
    
  - Behat (with-JS scenarios)

    ```bash
    $ bin/behat
    ```