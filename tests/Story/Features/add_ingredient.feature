Feature: add ingredient

  In order to add ingredient
  a recipe is required
  As user I pass name,
  type and amount

  Scenario: adding ingredients
    Given Certain recipe
    When I add ingredient
    Then I see it in recipe