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
  Scenario: Open The Overlay
    When I am on the yellow-box page
    Then I should see the yellow-box overlay
    And i click on the yellow-box symbol
    Then i should see the expanded yellow-box overlay