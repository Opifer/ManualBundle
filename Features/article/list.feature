Feature: List Articles
  In order to see the articles
  As a website admin
  I need to be authenticated

Background:
  Given   I am authenticated as "admin" using "password"
  When    I index the articles

Scenario: Display article list
  Given   I am on "admin/help"
  Then    I should see "Opifer CMS User Manual"
  And     I should see "Getting Started"
  And     I should see "Markdown Examples"
  And     I follow "Markdown Examples"
  Then    I should be on "admin/help/markdown-examples"
  And     I should see "Links"

Scenario: Redirect back to the articles list
  Given   I am on "admin/help/getting-started"
  Then    I should see "Getting Started"
  And     I follow "Getting Started"
  Then    I should be on "admin/help"