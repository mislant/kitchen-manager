Feature: Delete ingredient

  In order to delete ingredient
  I as user should get recipe and
  trash ingredient by name

  Scenario: Deleting ingredient
    Given Certain recipe
    And Ingredient milk in recipe
    When I delete ingredient milk
    Then I dont have milk in recipe