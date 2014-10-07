Feature: Show article
  In order to view and article
  As A website admin
  I need to be authenticated

Background:
  Given   I am authenticated as "admin" using "password"
  When    I index the articles

Scenario: View Getting Started article
  Given   I am on "admin/help"
  And     I follow "Getting Started"
  Then    I should see "Getting started"
  And     I should see "Last updated at:"
  And     I follow "Getting Started"
  Then    I should be on "admin/help"

Scenario: View Markdown Example article
  Given   I am on "admin/help"
  And     I follow "Markdown Examples"
  Then    I should see "Markdown Examples"
  And     I should see "Last updated at:"
  And     I follow "Getting Started"
  Then    I should be on "admin/help"
