@yellowbox
Feature: Managing Features with the YellowBox
  In order to manage Features with the YellowBox
  as a customer
  I want to be able approve and decline features

  Background:
    Given the store operates on a single channel in "EUR" currency
    And I am on the yellow-box page
    And there is no yellowbox cookie

  @ui
  Scenario: I Visit the shop-page
    Then I should see the yellow-box overlay

  @ui @javascript
  Scenario: I open and close the overlay
    Then I should see the yellow-box overlay
    And I click on the yellow-box symbol
    Then I should see the expanded yellow-box overlay
    And I click on the close button
    Then I should not see the expanded yellow-box overlay

  @ui @javascript
  Scenario: I see storys
    Then I should see the yellow-box overlay
    And I click on the yellow-box symbol
    Then I should see storys

  @ui @javascript
  Scenario: I approve and get a warning
    Then I should see the yellow-box overlay
    And I click on the yellow-box symbol
    When I click on approve
    Then I should see an warning message

  @ui @javascript
  Scenario: I decline and get a warning
    Then I should see the yellow-box overlay
    And I click on the yellow-box symbol
    When I click on decline
    Then I should see an warning message and an input field

  @ui @javascript
  Scenario: I approve and submit
    Then I should see the yellow-box overlay
    And I click on the yellow-box symbol
    When I click on approve
    And I click on submit
    Then I should not see an warning message

  @ui @javascript
  Scenario: I decline and submit
    Then I should see the yellow-box overlay
    And I click on the yellow-box symbol
    When I click on decline
    And I fill in the reason field
    And I click on submit
    Then I should not see an warning message

  @ui @javascript
  Scenario: I approve and cancel
    Then I should see the yellow-box overlay
    And I click on the yellow-box symbol
    When I click on approve
    Then I should see an warning message
    Then I cancel the change

  @ui @javascript
  Scenario: I decline and cancel
    Then I should see the yellow-box overlay
    And I click on the yellow-box symbol
    When I click on decline
    Then I should see an warning message
    Then I cancel the change
