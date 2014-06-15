Feature: Gist Controller
  In order to anonymously post gists
  As a user
  I need some behat in this place

  Scenario: Index Gist
    Given I have "10" gists
    And I am on the homepage
    Then I should see 5 gists

  Scenario: Store Gist
    Given I am on the homepage
    When I create a gist
    Then I should be on the gist page

  Scenario: Show Gist
    Given I have a gist
    And I am on that gist page
    Then I should see that gist

  Scenario: Update Gist
    Given I have a gist
    And I am on that gist page
    When I update the gist
    Then I should see that gist

  Scenario: Flag Gist
    Given I have a gist
    And I am on that gist page
    Then I fail
