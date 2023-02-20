Feature: Adding new recipe

  In order to add new recipe
  I as user should write dish name
  amount of calories and short
  description

  Scenario: I want add recipe
    Given Empty recipes list
    When I write new recipe
    Then I see it in list

  Scenario: I cant create same recipe
    Given Certain recipe
    When I write same recipe
    Then I have error of same recipe