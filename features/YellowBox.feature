@yellowbox
Feature: Managing Features with the YellowBox
  In order to manage Features with the YellowBox
  as a customer
  I want to be able approve and decline features

  Background:
    Given the store operates on a single channel in "EUR" currency
    And I am on the homepage
    And there is no yellowbox cookie

  @ui
  Scenario: I Visit the Shop and its not broken
    When I am on the homepage
    Then I should be on the homepage

  @ui @todo
  Scenario: I see the yellow-box
    When I am on the homepage
    Then I should see the yellow-box overlay

  @ui @javascript @todo
  Scenario: I open the overlay
    Given I see the yellow-box overlay
    When I click on the yellow-box symbol
    Then I should see the expanded yellow-box overlay

  @ui @javascript @todo
  Scenario: I close the overlay
    Given I see the yellow-box overlay
    When I click on the yellow-box symbol
    And I click on the close button
    Then I should not see the expanded yellow-box overlay

  @ui @javascript @todo
  Scenario: I see storys
    Given I see the yellow-box overlay
    When I click on the yellow-box symbol
    Then I should see storys

  @ui @javascript @todo
  Scenario: I approve and get a warning
    Given I see the yellow-box overlay
    When I click on the yellow-box symbol
    And I click on approve
    Then I should see a warning message

  @ui @javascript @todo
  Scenario: I decline and get a warning
    Given I see the yellow-box overlay
    When I click on the yellow-box symbol
    And I click on decline
    Then I should see a warning message and an input field

  @ui @javascript @todo
  Scenario: I approve and submit
    Given I see the yellow-box overlay
    When I click on the yellow-box symbol
    And I click on approve
    And I click on submit
    Then I should not see a warning message

  @ui @javascript @todo
  Scenario: I decline and submit
    Given I see the yellow-box overlay
    When I click on the yellow-box symbol
    And I click on decline
    And I fill in the reason field
    And I click on submit
    Then I should not see a warning message

  @ui @javascript @todo
  Scenario: I approve and cancel
    Given I see the yellow-box overlay
    When I click on the yellow-box symbol
    And I click on approve
    Then I should see a warning message
    And I should be able to cancel the change

  @ui @javascript @todo
  Scenario: I decline and cancel
    Given I see the yellow-box overlay
    When I click on the yellow-box symbol
    And I click on decline
    Then I should see a warning message
    And I should be able to cancel the change
