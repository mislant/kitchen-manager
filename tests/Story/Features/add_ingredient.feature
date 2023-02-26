Feature: Adding new ingredient

  In order to add ingredient
  a recipe is required
  As user I pass name,
  type and amount

  Scenario: Adding ingredients
    Given Certain recipe
    When I add ingredient
    Then I see it in recipe

  Scenario: Can not add same ingredients
    Given Certain recipe
    When I add ingredient milk
    And I add ingredient milk
    Then I have error of same ingredient in recipe
