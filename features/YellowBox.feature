@yellowbox
Feature: Managing Features with the YellowBox
  In order to manage Features with the YellowBox
  as a customer
  I want to be able approve and decline features

  Background:
    Given the store operates on a single channel in "EUR" currency

  @ui
  Scenario: Visit the shop-page
    When I am on the yellow-box page
    Then I should see the yellow-box overlay

  @ui @javascript
  Scenario: open and close the overlay
    When I am on the yellow-box page
    Then I should see the yellow-box overlay
    And i click on the yellow-box symbol
    Then i should see the expanded yellow-box overlay
    And i click on the close button
    Then i should not see the expanded yellow-box overlay

  @ui @javascript
  Scenario: i see storys
    When I am on the yellow-box page
    Then I should see the yellow-box overlay
    And i click on the yellow-box symbol
    Then i should see storys

  @ui @javascript
  Scenario: i approve and get a warning
    When I am on the yellow-box page
    Then I should see the yellow-box overlay
    And i click on the yellow-box symbol
    When i click on approve
    Then i should see an warning message

  @ui @javascript
  Scenario: i decline and get a warning
    When I am on the yellow-box page
    Then I should see the yellow-box overlay
    And i click on the yellow-box symbol
    When i click on approve
    Then i should see an warning message and an input field

  @ui @javascript
  Scenario: i approve and submit
    When I am on the yellow-box page
    Then I should see the yellow-box overlay
    And i click on the yellow-box symbol
    When i click on approve
    And i click on submit
    Then i should see a success message

  @ui @javascript
  Scenario: i decline and submit
    When I am on the yellow-box page
    Then I should see the yellow-box overlay
    And i click on the yellow-box symbol
    When i click on approve
    And i fill in the reason field
    And i click on submit
    Then i should see a success message

  @ui @javascript
  Scenario: i approve and cancel
    When I am on the yellow-box page
    Then I should see the yellow-box overlay
    And i click on the yellow-box symbol
    When i click on approve
    Then i should see an warning message
    Then i cancel the change

  @ui @javascript
  Scenario: i decline and cancel
    When I am on the yellow-box page
    Then I should see the yellow-box overlay
    And i click on the yellow-box symbol
    When i click on decline
    Then i should see an warning message
    Then i cancel the change
