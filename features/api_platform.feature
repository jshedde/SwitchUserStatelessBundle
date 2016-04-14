Feature: As user, I should be able to see my profile as JSON-LD, and to impersonate somebody's profile as JSON-LD

  Scenario: As user, I should be able to see my profile as JSON-LD
    When I get my profile
    Then I should see my complete profile as JSON-LD

  Scenario: As user, I should be able to impersonate somebody's profile as JSON-LD
    When I impersonate somebody's profile
    Then I should see somebody's complete profile as JSON-LD
